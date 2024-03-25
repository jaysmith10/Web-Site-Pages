<?php
include 'class retrieval.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <META name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
href="/css styles/booking.css">
    <title>Gym Booking</title>
</head>
<body>

    <div class="container booking">
        <h2>Gym Class Booking</h2>
        <form action="booking script.php" method="post">
            <label for="class">Select a class:</label>
            <select name="class" id="class" required>
            <?php echo $classOptions;

            </select>
            <button type="submit">Book Now</button>
        </form>
    </div>
</body>
</html>