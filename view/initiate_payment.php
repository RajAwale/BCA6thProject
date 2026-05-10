<?php
/**
 * initiate_payment.php
 * Place this file in: frontend/initiate_payment.php
 * (same folder as ticket.php so the fetch('./initiate_payment.php') path works)
 */

session_start();
include "./../backend/connection.php";
include "./../backend/getbus.php";

header('Content-Type: application/json');

// ── Method guard ──────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// ── Auth guard ────────────────────────────────────────────────────────────────
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    http_response_code(401);
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

// ── Parse body ────────────────────────────────────────────────────────────────
$body  = json_decode(file_get_contents('php://input'), true);
$bid   = isset($body['bid'])                              ? intval($body['bid'])   : 0;
$uid   = isset($body['uid'])                              ? intval($body['uid'])   : 0;
$seats = isset($body['seats']) && is_array($body['seats']) ? $body['seats']        : [];

if (!$bid || !$uid || empty($seats)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing: bid=' . $bid . ' uid=' . $uid . ' seats=' . count($seats)]);
    exit;
}

$seats = array_map('htmlspecialchars', $seats);

// ── Get bus from DB (authoritative price) ─────────────────────────────────────
$bus = getBusById($connection, $bid);
if (empty($bus)) {
    http_response_code(404);
    echo json_encode(['error' => 'Bus not found for bid=' . $bid]);
    exit;
}

$ticketPrice = (float) $bus[0]['ticketprice'];
$bname       = $bus[0]['bname'];
$source      = $bus[0]['source'];
$destination = $bus[0]['destination'];
$totalPrice  = $ticketPrice * count($seats);
$amountPaisa = (int) round($totalPrice * 100); // Khalti needs paisa

// ── Store in session for verify step ─────────────────────────────────────────
$_SESSION['pending_booking'] = [
    'bid'   => $bid,
    'uid'   => $uid,
    'seats' => $seats,
    'price' => $totalPrice,
];

// ─────────────────────────────────────────────────────────────────────────────
// CONFIGURATION
// For local dev  → use test key + dev.khalti.com endpoint
// For production → use live key + khalti.com endpoint
// ─────────────────────────────────────────────────────────────────────────────
$isLocalDev = ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1');

if ($isLocalDev) {
    $khaltiSecretKey = 'd4a5a7395dea416fbdb4b8e797326828'; // Get from Khalti dashboard → Test mode
    $khaltiInitUrl   = 'https://dev.khalti.com/api/v2/epayment/initiate/';
    $returnUrl       = 'http://' . $_SERVER['HTTP_HOST'] . '/busticket/view/bookings.php';
    $websiteUrl      = 'http://' . $_SERVER['HTTP_HOST'] . '/busticket/view/';
} else {
    $khaltiSecretKey = 'd4a5a7395dea416fbdb4b8e797326828'; // Get from Khalti dashboard → Live mode
    $khaltiInitUrl   = 'https://khalti.com/api/v2/epayment/initiate/';
    $returnUrl       = 'http://' . $_SERVER['HTTP_HOST'] . '/busticket/view/bookings.php';
    $websiteUrl      = 'http://' . $_SERVER['HTTP_HOST'] . '/busticket/view/';
}

// ── Build payload ─────────────────────────────────────────────────────────────
$seatLabel = implode(', ', $seats);
$orderId   = 'BUS' . $bid . '-' . implode('', $seats) . '-U' . $uid . '-' . time();

$payload = [
    'return_url'          => $returnUrl,
    'website_url'         => $websiteUrl,
    'amount'              => $amountPaisa,
    'purchase_order_id'   => $orderId,
    'purchase_order_name' => $bname . ' | ' . $source . ' to ' . $destination . ' | Seats: ' . $seatLabel,
    'customer_info'       => [
        // Khalti accepts empty strings — these are optional
        'name'  => !empty($_SESSION['name'])  ? $_SESSION['name']  : 'Customer',
        'email' => !empty($_SESSION['email']) ? $_SESSION['email'] : 'customer@example.com',
        'phone' => !empty($_SESSION['phone']) ? $_SESSION['phone'] : '9800000000',
    ],
];

// ── Call Khalti API ───────────────────────────────────────────────────────────
$ch = curl_init($khaltiInitUrl);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_HTTPHEADER     => [
        'Authorization: Key ' . $khaltiSecretKey,
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode($payload),
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr  = curl_error($ch);
curl_close($ch);

// ── Debug log (remove in production) ─────────────────────────────────────────
error_log('[Khalti Init] HTTP=' . $httpCode . ' Response=' . $response);
if ($curlErr) error_log('[Khalti cURL Error] ' . $curlErr);

// ── Respond ───────────────────────────────────────────────────────────────────
$result = json_decode($response, true);

if ($httpCode === 200 && isset($result['payment_url'])) {
    echo json_encode([
        'success'     => true,
        'payment_url' => $result['payment_url'],
        'pidx'        => $result['pidx'],
    ]);
} else {
    // Return full Khalti error so the browser alert shows what went wrong
    http_response_code(500);
    echo json_encode([
        'error'    => 'Khalti initiation failed (HTTP ' . $httpCode . ')',
        'details'  => $result,
        'curl_err' => $curlErr ?: null,
    ]);
}