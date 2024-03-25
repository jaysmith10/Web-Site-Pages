<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css_styles/styleTH.css" />
    <title>Welcome</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="/index.html">Home</a></li>
        <li><a href="/page1.html">Weather</a></li>
        <li><a href="/Widget.html">Widget</a></li>
        <li><a href="/targetheartrate.html">Target Calculate</a></li>
        <li><a href="/php_scripts/makebooking.php">Make a booking</a></li>
    </ul>
</nav>
<div class="title-wrapper">
    <div class="content_title">
        <h2>Welcome to the Gym!</h2>
        <?php
          if (isset($_SESSION['username'])) {
            $username = htmlspecialchars($_SESSION['username']);
            echo "<p>Hello, $username!</p>";
        }
        ?>
        <p>This is the welcome page. You can customize this page with content relevant to the user.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</div>
<div class="image-container">
    <div class="flex-item">
        <a href="/php_scripts/booking.php">
            <img src="/images/Booking.png" alt="Bookings" class="image">
            <div class="overlay-text">Bookings</div>
        </a>
    </div>
    <div class="flex-item">
        <img src="/images/Tracking.png" alt="Your Results" class="image">
        <div class="overlay-text">Your Results</div>
    </div>
    <div class="flex-item">
        <img src="/images/Tracking.png" alt="Classes" class="image">
        <div class="overlay-text">Classes </div>
    </div>
      <div class="flex-item">
    <a href="/php_scripts/account_info.php">
        <img src="/images/Tracking.png" alt="Classes" class="image">
        <div class="overlay-text">Account Information </div>
    </div>
</div>


</body>
</html>