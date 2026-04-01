<?php 
        include "./header.php"; 
        include "./../backend/connection.php";
        include "./../backend/getbus.php";
        include "./../backend/getseat.php";
        include "./utils/distance.php";

        if(isset($_GET['bid'])){
            $bid = $_GET['bid'];
            $bus = getBusById($connection, $bid); 

            $bname= $bus[0]['bname'];
            $ticketPrice= $bus[0]['ticketprice'];
            $sourceAddress= $bus[0]['source'];
            $destinationAddress= $bus[0]['destination'];
            $hasWifi= $bus[0]['haswifi'];
            $hasAc= $bus[0]['hasac'];
            $pickupLocations= $bus[0]['pickuplocations'];

            $coordinates = [];
            $pickupLocation = "empty";
            
            if($_SESSION && $_SESSION['loggedin']==true && $_SESSION['ulocation']!="empty"){
                $locationsArray = explode('xxx', $pickupLocations);

                foreach ($locationsArray as $location) {
                    $latLng = explode('zzz', $location);
                    if (count($latLng) === 2) {
                        array_push($coordinates, [(float)$latLng[0], (float)$latLng[1]]);
                    }
                }

                $ulocation = explode("zzz", $_SESSION['ulocation']);
                $pickupLocation = bestPickup($ulocation, $coordinates);
            }
        } 
        else {
            echo "Bus ID not provided.";
            exit;
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seats - <?php echo $bus[0]['bname']; ?></title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/ticket.css">
</head>
<body>   
    <?php
        if($_SESSION && $_SESSION['loggedin']==true) { 
            echo '<div class="user-session-id hide" data-id="'. $_SESSION['id'] .'"></div>';
        }
        else{
            echo '<div class="user-session-id hide" data-id="empty"></div>';   
        }
    ?>
    <div class="bus-info">
        <h2>Bus Name: <?php echo $bname; ?></h2>
        <p>Ticket Price: Rs <?php echo $ticketPrice; ?></p>
        <p>Source: <?php echo $sourceAddress; ?> | Destination: <?php echo $destinationAddress; ?></p>
        <p>Wifi: <?php echo $hasWifi ? 'Available' : 'Not Available'; ?></p>
        <p>AC: <?php echo $hasAc ? 'Available' : 'Not Available'; ?></p>
    </div>

    <div class="seat-container-outer">
        <?php 
            echo '<div class="seat-container" data-id="'. $bid .'">
                <div class="row">
                    '. (getSeatStatus($connection, $bid, 'A1') == 0 ? '<div class="seat">A1</div>' : '<div class="seat booked">A1</div>') . 
                    (getSeatStatus($connection, $bid, 'A2') == 0 ? '<div class="seat">A2</div>' : '<div class="seat booked">A2</div>') .'
                    <div class="gap"></div>
                    '. (getSeatStatus($connection, $bid, 'B1') == 0 ? '<div class="seat">B1</div>' : '<div class="seat booked">B1</div>') . 
                    (getSeatStatus($connection, $bid, 'B2') == 0 ? '<div class="seat">B2</div>' : '<div class="seat booked">B2</div>') .'
                </div>
                <div class="row">
                    '. (getSeatStatus($connection, $bid, 'A3') == 0 ? '<div class="seat">A3</div>' : '<div class="seat booked">A3</div>') . 
                    (getSeatStatus($connection, $bid, 'A4') == 0 ? '<div class="seat">A4</div>' : '<div class="seat booked">A4</div>') .'
                    <div class="gap"></div>
                    '. (getSeatStatus($connection, $bid, 'B3') == 0 ? '<div class="seat">B3</div>' : '<div class="seat booked">B3</div>') . 
                    (getSeatStatus($connection, $bid, 'B4') == 0 ? '<div class="seat">B4</div>' : '<div class="seat booked">B4</div>') .'
                </div>
                <div class="row">
                    '. (getSeatStatus($connection, $bid, 'A5') == 0 ? '<div class="seat">A5</div>' : '<div class="seat booked">A5</div>') . 
                    (getSeatStatus($connection, $bid, 'A6') == 0 ? '<div class="seat">A6</div>' : '<div class="seat booked">A6</div>') .'
                    <div class="gap"></div>
                    '. (getSeatStatus($connection, $bid, 'B5') == 0 ? '<div class="seat">B5</div>' : '<div class="seat booked">B5</div>') . 
                    (getSeatStatus($connection, $bid, 'B6') == 0 ? '<div class="seat">B6</div>' : '<div class="seat booked">B6</div>') .'
                </div>
                <div class="row">
                    '. (getSeatStatus($connection, $bid, 'A7') == 0 ? '<div class="seat">A7</div>' : '<div class="seat booked">A7</div>') . 
                    (getSeatStatus($connection, $bid, 'A8') == 0 ? '<div class="seat">A8</div>' : '<div class="seat booked">A8</div>') .'
                    <div class="gap"></div>
                    '. (getSeatStatus($connection, $bid, 'B7') == 0 ? '<div class="seat">B7</div>' : '<div class="seat booked">B7</div>') . 
                    (getSeatStatus($connection, $bid, 'B8') == 0 ? '<div class="seat">B8</div>' : '<div class="seat booked">B8</div>') .'
                </div>
                <div class="last-row">
                    '. (getSeatStatus($connection, $bid, 'A9') == 0 ? '<div class="seat">A9</div>' : '<div class="seat booked">A9</div>') . 
                    (getSeatStatus($connection, $bid, 'A10') == 0 ? '<div class="seat">A10</div>' : '<div class="seat booked">A10</div>') .
                    (getSeatStatus($connection, $bid, 'A11') == 0 ? '<div class="seat">A11</div>' : '<div class="seat booked">A11</div>') .
                    (getSeatStatus($connection, $bid, 'B9') == 0 ? '<div class="seat">B9</div>' : '<div class="seat booked">B9</div>') .
                    (getSeatStatus($connection, $bid, 'B10') == 0 ? '<div class="seat">B10</div>' : '<div class="seat booked">B10</div>') .'
                </div>
            </div>';
        ?>
    </div>

    <div class="pickup-info">
        <?php
            if($pickupLocation != "empty"){
                echo "Suggested pickup location for you is " . $pickupLocation;
            }
            else {
                echo "Add your location to get the best pickup location";
            }
        ?>
    </div>

    <div class="book-ticket">
        <?php 
            echo ($_SESSION && $_SESSION['loggedin']==true) ? 
            "<div class='book-txt'>Select a seat to book</div>
            <button class='book-btn'>Book</button>" :
            "<b>Login </b> to book the ticket"; 
         ?>
    </div>

    <script src="./js/ticket.js"></script>
</body>
</html>
