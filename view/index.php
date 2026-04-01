<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MahaBus</title>
  <link rel="icon" type="image/x-icon" href="./imgs/bus.png">
  <!-- animate -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital@0;1&display=swap" rel="stylesheet">
  <!-- css links -->
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
  <?php include "./header.php" ?>

  <section class="landing-section">
    <div class="tagline-container" data-aos="zoom-in-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
      <h1>"महाबस: तपाईंको यात्रा अनुभवलाई सरल र सुरक्षित बनाउँदै।"</h1>
    </div>
    <div class="form-container">
      <form action="./buses.php" method="GET">
        <input type="text" placeholder="Pickup Destination" name="sourceAddress" required>
        <input type="text" placeholder="To Destination" name="destinationAddress" required>
        <input type="date" placeholder="Date of Pickup">
        <button type="submit">Book</button>
      </form>
    </div>
  </section>

  <section class="features-section">
    <h2>Why Mahabus</h2>
    <div class="feature-box">
        <h3>Simple Booking</h3>
        <p>Book bus tickets anytime anywhere with a simple and interactive interface.</p>
    </div>
    <div class="feature-box">
        <h3>No Hidden Charges</h3>
        <p>Find the best deals without any hidden charges.</p>
    </div>
  </section>

  <section class="city-buses-section">
    <h2>Popular Bus Routes</h2>
    <div class="city-bus-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Biratnagar'">
        <img src="./imgs/ktm-bir.jpg" alt="City 1">
        <div class="city-text">Kathmandu to Biratnagar</div>
    </div>
    <div class="city-bus-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Pokhara'">
        <img src="./imgs/ktm-pkr.jpg" alt="City 2">
        <div class="city-text">Kathmandu to Pokhara</div>
    </div>
    <div class="city-bus-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Janakpur'">
        <img src="./imgs/ktm-jan.jpg" alt="City 1">
        <div class="city-text">Kathmandu to Janakpur</div>
    </div>
    <div class="city-bus-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Nepalgunj'">
        <img src="./imgs/ktm-nep.jpg" alt="City 2">
        <div class="city-text">Kathmandu to Nepalgunj</div>
    </div>
    <div class="city-bus-box" onclick="window.location.href='./buses.php?sourceAddress=Pokhara&destinationAddress=Kathmandu'">
        <img src="./imgs/pkr-ktm.webp" alt="City 1">
        <div class="city-text">Pokhara to Kathmandu</div>
    </div>
  </section>

  <section class="other-routes-section"  data-aos="zoom-in-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
    <h2>Other Routes</h2>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Jhapa'">Kathmandu to Jhapa</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Mahottari'">Kathmandu to Mahottari</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Chitwan'">Kathmandu to Chitwan</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Ilam'">Kathmandu to Ilam</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Dolakha'">Kathmandu to Dolakha</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Okhaldhunga'">Kathmandu to Okhaldhunga</div>
    <div class="route-box" onclick="window.location.href='./buses.php?sourceAddress=Kathmandu&destinationAddress=Butwal'">Kathmandu to Butwal</div>
  </section>

  <footer>
    Created by Rubek and Stephen
  </footer>

  <script>
    AOS.init();
  </script>
</body>
</html>