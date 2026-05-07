<!-- <?php session_start(); ?> -->
<!-- header section -->
<header class="header">
    <div class="title" onclick="window.location.href='/busticket/view'">MahaBus</div>

    <?php if ($_SESSION && $_SESSION['loggedin'] == true) { ?>
        <div class="buttons">
            <span class="username">
                Hi, <?php echo $_SESSION['username']; ?>!
                <!-- <i class="fas fa-map-marker-alt" onclick="openLocationModal()" style="cursor: pointer;">
                    <span class="location">Add Location</span>
                </i> -->

                <span  class="location" onclick="openLocationModal()" style="cursor: pointer; margin-left: 1rem;"> Add Location</span>
               
            </span>
            <span class="booking-history-txt" onclick="window.location.href='./bookings.php'">Booking history</span>
            <button onclick="window.location.href='./../backend/logout.php'">Log out</button>
        </div>
    <?php } else { ?>
        <div class="buttons">
            <button onclick="window.location.href='login.php'">Login</button>
            <button onclick="window.location.href='signup.php'">Sign Up</button>
        </div>
    <?php } ?>
</header>

<div id="locationModal" class="modal"> 
    <div class="modal-content">
        <span class="close" onclick="closeLocationModal()">&times;</span>
        <h2>Select Your Location</h2>
        <div id="map" style="height: 400px;"></div>
        <form method="POST" action="./../backend/postlocation.php">
            <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
            <input class="location-inp" type="hidden" name="ulocation">
            <button type="submit">Confirm Location</button>
        </form>
    </div>
</div>

<!-- Include Leaflet for the map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- Include Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="./js/header.js"></script>
