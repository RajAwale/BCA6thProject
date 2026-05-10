<?php
/**
 * booking_success.php
 * Shown after Khalti payment is verified and seats are booked in the DB.
 * Receives: ?bid=...&seats=A1,A2&pidx=...
 */

session_start();
include "./header.php";
include "./../backend/connection.php";
include "./../backend/getbus.php";

$bid      = isset($_GET['bid'])   ? intval($_GET['bid'])             : 0;
$seatsRaw = isset($_GET['seats']) ? htmlspecialchars($_GET['seats'])  : '';
$pidx     = isset($_GET['pidx'])  ? htmlspecialchars($_GET['pidx'])   : '';

$seatList  = $seatsRaw ? explode(',', $seatsRaw) : [];
$seatCount = count($seatList);

$bus   = $bid ? getBusById($connection, $bid) : [];
$bname = $bus[0]['bname']       ?? 'N/A';
$from  = $bus[0]['source']      ?? 'N/A';
$to    = $bus[0]['destination'] ?? 'N/A';
$price = (float)($bus[0]['ticketprice'] ?? 0);
$total = $price * $seatCount;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmed</title>
    <link rel="stylesheet" href="./css/common.css">
    <style>
        body { background: #f0f0f0; }
        .success-card {
            max-width: 480px;
            margin: 60px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,.1);
            padding: 40px 32px;
            text-align: center;
            font-family: sans-serif;
        }
        .success-icon { font-size: 60px; margin-bottom: 8px; }
        h1 { color: #2d8a4e; margin: 0 0 8px; }
        .subtitle { color: #555; margin-bottom: 24px; }
        .ticket-details {
            background: #f7f7f7;
            border-radius: 8px;
            padding: 16px 20px;
            text-align: left;
            margin-bottom: 16px;
        }
        .ticket-details p {
            margin: 7px 0;
            font-size: 15px;
            color: #333;
        }
        .ticket-details strong { color: #111; }
        .badge {
            display: inline-block;
            background: #e8f5e9;
            color: #2d8a4e;
            border-radius: 20px;
            padding: 2px 10px;
            font-size: 13px;
            font-weight: bold;
            margin-left: 6px;
        }
        .txn-id {
            font-size: 11px;
            color: #aaa;
            word-break: break-all;
            margin: 8px 0 24px;
        }
        .btn-home {
            display: inline-block;
            padding: 12px 32px;
            background: #5d2d91;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }
        .btn-home:hover { background: #4a2175; }
    </style>
</head>
<body>
    <div class="success-card">
        <div class="success-icon">🎉</div>
        <h1>Booking Confirmed!</h1>
        <p class="subtitle">
            Your <?php echo $seatCount > 1 ? $seatCount . ' seats have' : 'seat has'; ?>
            been booked and payment received via <strong>Khalti</strong>.
        </p>

        <div class="ticket-details">
            <p><strong>Bus:</strong> <?php echo htmlspecialchars($bname); ?></p>
            <p><strong>Route:</strong> <?php echo htmlspecialchars($from); ?> → <?php echo htmlspecialchars($to); ?></p>
            <p>
                <strong>Seat<?php echo $seatCount > 1 ? 's' : ''; ?>:</strong>
                <?php foreach ($seatList as $s): ?>
                    <span class="badge"><?php echo htmlspecialchars(trim($s)); ?></span>
                <?php endforeach; ?>
            </p>
            <p><strong>Price per seat:</strong> Rs <?php echo number_format($price, 2); ?></p>
            <?php if ($seatCount > 1): ?>
                <p><strong>Total paid:</strong> Rs <?php echo number_format($total, 2); ?></p>
            <?php endif; ?>
        </div>

        <?php if ($pidx): ?>
            <p class="txn-id">Khalti Transaction ID: <?php echo $pidx; ?></p>
        <?php endif; ?>

        <a href="./" class="btn-home">Back to Home</a>
    </div>
</body>
</html>