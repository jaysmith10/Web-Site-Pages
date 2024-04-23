<?php
include 'retrieval.php'; // This will execute the PHP code for retrieving class options.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css_styles/style.css" />
  <title>Gym Booking</title>
</head>
<body>

<nav>
    <ul>
        <li><a href="../index.html">Home</a></li>
        <li><a href="../page1.html">Weather</a></li>
        <li><a href="../Widget_Time.html">Widget</a></li>
        <li><a href="../Target Calc.html">Target Calculate</a></li>
    </ul>
</nav>

<div class="container_booking">
    <h1>Gym Class Booking</h1>

    <form id="bookingForm" action="booking_script.php" method="post">
        <div class="form-field">
            <label for="class">Select a Class:</label>
            <select name="class" id="class" required>
                <?php echo $classOptions; ?>
            </select>
        </div>

        <div class="form-field">
            <label for="adultPlaces">Number of Adult Places:</label>
            <input type="number" id="adultPlaces" name="adultPlaces" min="0" value="0" required>
        </div>

        <div class="form-field">
            <label for="childPlaces">Number of Child Places:</label>
            <input type="number" id="childPlaces" name="childPlaces" min="0" value="0" required>
        </div>

        <div class="form-field checkbox-field">
            <label>
                <input type="checkbox" id="groupBookingCheckbox" name="groupBookingCheckbox">
                Group Booking (10+ places)
            </label>
        </div>

        <div class="form-field">
            <label for="booking_date">Booking Date:</label>
            <input type="date" id="booking_date" name="booking_date" required>
        </div>

        <button type="submit">Book Now</button>
    </form>

    <div id="messageContainer"></div>

    <?php if(isset($_SESSION['booking_confirmation'])): ?>
    <div class="booking_confirmation">
        <p><?php echo $_SESSION['booking_confirmation']; ?></p>
    </div>
    <?php unset($_SESSION['booking_confirmation']); endif; ?>

    <div>
        <button type="button" id="viewBookingsBtn">View My Bookings</button>
        <div id="bookingsContainer"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const groupBookingCheckbox = document.getElementById('groupBookingCheckbox');
    const adultPlaces = document.getElementById('adultPlaces');
    const childPlaces = document.getElementById('childPlaces');
    const messageContainer = document.getElementById('messageContainer');

    function updatePlacesLimit() {
        if (groupBookingCheckbox.checked) {
            adultPlaces.min = 0;
            childPlaces.min = 0;
            adultPlaces.max = 100;
            childPlaces.max = 100;
        } else {
            adultPlaces.value = 0;
            childPlaces.value =0;
            adultPlaces.min = 0;
            childPlaces.min = 0;
            adultPlaces.max = 9;
            childPlaces.max = 9;
        }
    }

    groupBookingCheckbox.addEventListener('change', function () {
        updatePlacesLimit();
        messageContainer.innerHTML = ''; // Clear any existing messages
    });

    document.getElementById('bookingForm').addEventListener('submit', function (event) {
        const totalPlaces = parseInt(adultPlaces.value) + parseInt(childPlaces.value);
        const isGroupBooking = groupBookingCheckbox.checked;

        if (isGroupBooking && totalPlaces < 10) {
            event.preventDefault();
            messageContainer.innerHTML = '<p>Group booking must be for 10 or more places.</p>';
        } else if (!isGroupBooking && totalPlaces > 9) {
            event.preventDefault();
            messageContainer.innerHTML = '<p>Individual booking cannot exceed 9 places.</p>';
        } else if (adultPlaces.value == 0 && childPlaces.value == 0) {
            event.preventDefault();
            messageContainer.innerHTML = '<p>At least one adult or child ticket must be booked.</p>';
        }
    });

    updatePlacesLimit(); // Set initial limits
});
</script>

<script>
    document.getElementById('viewBookingsBtn').addEventListener('click', function() {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'show_bookings.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send('param1=value1&param2=value2');

        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                document.getElementById('bookingsContainer').innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
</script>

</body>
</html>