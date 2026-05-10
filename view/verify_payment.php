<?php
/**
 * verify_payment.php
 * Khalti redirects here after the user completes (or cancels) payment.
 * URL params from Khalti: ?pidx=...&status=Completed&purchase_order_id=...
 *
 * Steps:
 *  1. Check Khalti's status param
 *  2. Call Khalti lookup API to independently verify
 *  3. Cross-check amount against session (tamper guard)
 *  4. Book each seat in the DB
 *  5. Redirect to success or back to ticket page on failure
 */

session_start();
include "./../backend/connection.php";
include "./../backend/getseat.php"; // needs: bookSeat($connection, $bid, $seat, $uid, $pidx) → bool

$khaltiSecretKey = 'd4a5a7395dea416fbdb4b8e797326828'; // ← same key as initiate_payment.php

$pidx    = isset($_GET['pidx'])   ? $_GET['pidx']   : '';
$status  = isset($_GET['status']) ? $_GET['status'] : '';
$pending = $_SESSION['pending_booking'] ?? null;
$bid     = $pending['bid'] ?? '';

// ── Step 1: Quick check on Khalti's redirect status ──────────────────────────
if ($status !== 'Completed' || !$pidx) {
    header('Location: ./ticket.php?bid=' . $bid . '&payment=failed');
    exit;
}

// ── Step 2: Independently verify with Khalti lookup API ──────────────────────
$ch = curl_init('https://a.khalti.com/api/v2/epayment/lookup/');
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Key ' . $khaltiSecretKey,
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$khaltiResult = json_decode($response, true);

if ($httpCode !== 200 || ($khaltiResult['status'] ?? '') !== 'Completed') {
    header('Location: ./ticket.php?bid=' . $bid . '&payment=failed');
    exit;
}

// ── Step 3: Session guard + amount tamper check ───────────────────────────────
if (!$pending) {
    // Session expired between initiation and return
    header('Location: ./?error=session_expired');
    exit;
}

$expectedPaisa = (int) round($pending['price'] * 100);
$receivedPaisa = (int) $khaltiResult['total_amount'];

if ($receivedPaisa !== $expectedPaisa) {
    error_log('Khalti tamper detected: expected=' . $expectedPaisa . ' received=' . $receivedPaisa . ' pidx=' . $pidx);
    header('Location: ./ticket.php?bid=' . $bid . '&payment=tampered');
    exit;
}

// ── Step 4: Book each seat in the database ────────────────────────────────────
$seats  = $pending['seats']; // e.g. ['A1', 'A2']
$uid    = $pending['uid'];
$failed = [];

foreach ($seats as $seat) {
    // bookSeat() should INSERT into your bookings/seats table
    // and return true on success, false on failure
    $ok = bookSeat($connection, $bid, $seat, $uid, $pidx);
    if (!$ok) {
        $failed[] = $seat;
    }
}

// Clear session — payment is done regardless of DB outcome
unset($_SESSION['pending_booking']);

// ── Step 5: Redirect ──────────────────────────────────────────────────────────
if (empty($failed)) {
    header(
        'Location: ./booking_success.php'
        . '?bid='   . urlencode($bid)
        . '&seats=' . urlencode(implode(',', $seats))
        . '&pidx='  . urlencode($pidx)
    );
} else {
    // Payment succeeded but DB booking failed — needs manual intervention
    error_log(
        'CRITICAL: Khalti pidx=' . $pidx . ' paid but seat booking failed.'
        . ' BID=' . $bid . ' SEATS=' . implode(',', $failed) . ' UID=' . $uid
    );
    header('Location: ./ticket.php?bid=' . $bid . '&payment=db_error');
}
exit;