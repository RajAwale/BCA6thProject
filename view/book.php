<?php
    include "./../backend/connection.php";
    include "./../backend/getbookings.php";

    session_start();
    if (!isset($_SESSION['id'])) {
        echo "You need to login first.";
        exit;
    }

    $uid = $_SESSION['id'];
    $bookings = getUserBookings($connection, $uid);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket History</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/bookings.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <?php include "./header.php"; ?>

    <div class="ticket-history-container">
        <h2>Your Ticket History</h2>
        <?php if (count($bookings) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Bus Name</th>
                    <th>Date</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Seat Number</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $ticket): ?>
                <tr data-busname="<?php echo $ticket['bname']; ?>" 
                    data-date="<?php echo $ticket['bookingtime']; ?>" 
                    data-source="<?php echo $ticket['source']; ?>" 
                    data-destination="<?php echo $ticket['destination']; ?>" 
                    data-seatnumber="<?php echo $ticket['seatno']; ?>" 
                    data-price="<?php echo $ticket['price']; ?>" 
                    class="ticket-row">
                    <td><?php echo $ticket['bname']; ?></td>
                    <td><?php echo $ticket['bookingtime']; ?></td>
                    <td><?php echo $ticket['source']; ?></td>
                    <td><?php echo $ticket['destination']; ?></td>
                    <td><?php echo $ticket['seatno']; ?></td>
                    <td>Rs <?php echo $ticket['price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
        <?php else: ?>
            <p>No tickets found.</p>
        <?php endif; ?>
    </div>

    <div class="ticket-modal">
        <div class="header">
            Bus Ticket
        </div>
        <div class="content">
            <p><strong>Bus Name:</strong> <span id="busName"></span></p>
            <p><strong>Date:</strong> <span id="date"></span></p>
            <p><strong>Source:</strong> <span id="source"></span></p>
            <p><strong>Destination:</strong> <span id="destination"></span></p>
            <p><strong>Seat Number:</strong> <span id="seatNumber"></span></p>
            <p><strong>Price:</strong> Rs <span id="price"></span></p>
        </div>
        <div class="footer">
            <button id="downloadPdfBtn">Download PDF</button>
            <button class="close-modal">Close</button>
        </div>
    </div>

    <script src="./js/bookings.js"></script>
</body>
</html>
