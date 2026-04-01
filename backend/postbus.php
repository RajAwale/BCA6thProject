<?php
if ($_POST) {
    $busName = $_POST['busName'];
    $ticketPrice = $_POST['ticketPrice'];
    $hasWifi = isset($_POST['hasWIFI']) ? 1 : 0;
    $hasAC = isset($_POST['hasAC']) ? 1 : 0;
    $sourceAddress = $_POST['sourceAddress'];
    $destinationAddress = $_POST['destinationAddress'];
    $pickupLocations = $_POST['pickupLocations'];

    include "connection.php";

    if ($connection) {
        $sql = "SELECT bname FROM buses WHERE bname='$busName' AND source='$sourceAddress' AND destination='$destinationAddress'";
        $result = mysqli_query($connection, $sql);

        if (!mysqli_num_rows($result) > 0) {
            $sql = "INSERT INTO buses (bname, price, haswifi, hasac, source, destination, pickuplocations) 
                    VALUES ('$busName', '$ticketPrice', '$hasWifi', '$hasAC', '$sourceAddress', '$destinationAddress', '$pickupLocations')";
            mysqli_query($connection, $sql);        

            $bid = mysqli_insert_id($connection);
            $sql = "INSERT INTO seats (bid, seatno)
                    VALUES ('$bid', 'A1'), ('$bid', 'A2'), ('$bid', 'A3'), ('$bid', 'A4'), ('$bid', 'A5'), ('$bid', 'A6'), ('$bid', 'A7'), ('$bid', 'A8'), ('$bid', 'A9'), ('$bid', 'A10'), ('$bid', 'A11'), ('$bid', 'B1'), ('$bid', 'B2'), ('$bid', 'B3'), ('$bid', 'B4'), ('$bid', 'B5'), ('$bid', 'B6'), ('$bid', 'B7'), ('$bid', 'B8'), ('$bid', 'B9'), ('$bid', 'B10')";
            mysqli_query($connection, $sql);

            echo "Bus registration successful";
            header("Location: ./../admin/");
        } else {
            echo "Bus with the same name, source, and destination already exists";
        }
    } else {
        echo "Connection failed";
    }
    mysqli_close($connection);
}
?>
