<?php
    include "./../backend/connection.php";
    include "./../backend/getbookings.php";
session_start();


$error = '';
$trip = $_GET['trip'] ?? '';
$amount = $_GET['amount'] ?? '';
$seat = $_GET['seat'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trip = trim($_POST['trip'] ?? '');
    $amount = trim($_POST['amount'] ?? '');
    $seat = trim($_POST['seat'] ?? '');

    if ($trip === '' || $amount === '') {
        $error = 'Missing trip or amount information. Please return to the previous page and try again.';
    } else {
        $_SESSION['booking'] = [
            'trip' => $trip,
            'amount' => $amount,
            'seat' => $seat,
        ];

        header('Location: payment.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        .container { max-width: 520px; margin: 0 auto; }
        .error { color: #b00020; margin-bottom: 20px; }
        .field { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 16px; background: #007bff; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Confirm Booking</h1>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="field">
                <label for="trip">Trip</label>
                <input type="text" id="trip" name="trip" value="<?= htmlspecialchars($trip) ?>" readonly>
            </div>
            <div class="field">
                <label for="seat">Seat</label>
                <input type="text" id="seat" name="seat" value="<?= htmlspecialchars($seat) ?>" readonly>
            </div>
            <div class="field">
                <label for="amount">Amount</label>
                <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($amount) ?>" readonly>
            </div>
            <button type="submit">Book and Proceed to Payment</button>
        </form>
    </div>
</body>
</html>
