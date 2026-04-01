<?php 
    session_start(); 

    if(!$_SESSION['admin']) header("Location: ./../view/login.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MahaBus Admin Page</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body>
    <div class="page-container">
        <h1 class="page-heading">MahaBus Admin Panel</h1>
        <center>
            <button class="logout-btn" onclick="window.location.href='./logout.php'">Log out</button>
        </center>
        <div class="form-container">
            <form method="post" action="./../backend/postbus.php">
                <div class="form-section">
                    <h2>Bus Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="busName">Bus Name:</label>
                            <input type="text" id="busName" name="busName" required>
                        </div>
                        <div class="form-group">
                            <label for="ticketPrice">Ticket Price:</label>
                            <input type="number" id="ticketPrice" name="ticketPrice" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Route Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="sourceAddress">Source Address:</label>
                            <input type="text" id="sourceAddress" name="sourceAddress" required>
                        </div>
                        <div class="form-group">
                            <label for="destinationAddress">Destination Address:</label>
                            <input type="text" id="destinationAddress" name="destinationAddress" required>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h2>Pickup Locations</h2>
                    <p>Click on the map to add pickup locations. Click again on a marker to remove it if added by mistake.</p>
                    <div id="map"></div>
                    <div id="pickupList"></div>
                    <input type="hidden" id="pickupLocations" name="pickupLocations">
                </div>

                <div class="form-section">
                    <h2>Bus Features</h2>
                    <div class="form-row">
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="hasAC" name="hasAC">
                            <label for="hasAC">Has AC</label>
                        </div>
                        <div class="form-group checkbox-group">
                            <input type="checkbox" id="hasWIFI" name="hasWIFI">
                            <label for="hasWIFI">Has WIFI</label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="./script.js"></script>
</body>
</html>
