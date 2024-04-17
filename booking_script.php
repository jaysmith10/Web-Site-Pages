<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "root";
$database = "gymdb";
$port = 8889;

$conn = new mysqli ($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class'])) {
//checks if the form has been submitted using the POST method and
//whether the 'class' input field has been set in the form data
    $user_id = $_SESSION['user_id'] ?? null;
    $class_id = $_POST['class']; // Get the data from input field class in //the form
    $adult_places_booked = $_POST['adultPlaces'] ?? 0;
    $child_places_booked = $_POST['childPlaces'] ?? 0;
    $total_places_booked = $adult_places_booked + $child_places_booked;
    $booking_date = $_POST['booking_date'];
    $adult_ticket_price = 30; // Adult ticket price
    $child_ticket_price = $adult_ticket_price * 0.5; // Child ticket price is 50% of adult's
    $discount = 0;

    // Check total places booked for individual or group
    $is_group_booking = $total_places_booked >= 10;

    // Fetch maximum spaces available for the class
    $maxSpacesQuery = "SELECT max_spaces FROM gym_classes WHERE class_id = ?";
    $stmt = $conn->prepare($maxSpacesQuery);
    $stmt->bind_param("i", $class_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $max_spaces_info = $result->fetch_assoc();
    $max_spaces = $max_spaces_info['max_spaces'] ?? 0;
    $stmt->close();

    // Calculate the total booked places for the class on the booking date
    $totalBookedQuery = "SELECT SUM(total_places_booked) AS total_booked FROM class_bookings WHERE class_id = ? AND booking_date = ?";
    $stmt = $conn->prepare($totalBookedQuery);
    $stmt->bind_param("is", $class_id, $booking_date);
    $stmt->execute();
    $bookedResult = $stmt->get_result();
    $booked_info = $bookedResult->fetch_assoc();
    $total_booked = $booked_info['total_booked'] ?? 0;
    $stmt->close();

    // Check if there are enough spaces left
    if ($total_places_booked + $total_booked <= $max_spaces) {
        if ($is_group_booking) {
            $discount = $total_places_booked >= 20 ? 10 : 5;
        }

        // Calculate total cost considering the different prices for adults and children
        $total_cost_before_discount = ($adult_ticket_price * $adult_places_booked) + ($child_ticket_price * $child_places_booked);
        $discount_amount = ($total_cost_before_discount * $discount) / 100;
        $total_cost = $total_cost_before_discount - $discount_amount;

        // Generate a unique booking reference
        $booking_reference = uniqid('booking_');

        // Insert booking into the database
        $insertQuery = "INSERT INTO class_bookings (user_id, class_id, booking_date, adult_places_booked, child_places_booked, total_places_booked, discount, total_cost, booking_reference) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("iisiiiids", $user_id, $class_id, $booking_date, $adult_places_booked, $child_places_booked, $total_places_booked, $discount, $total_cost, $booking_reference);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['booking_confirmation'] = "Booking successful!<br>Booking Reference: $booking_reference.<br>You have booked: $total_places_booked places for class ID $class_id on $booking_date.<br>Total Cost: £$total_cost<br>Discount: $discount%";
        } else {
            $_SESSION['booking_confirmation'] = "Error in booking: " . $conn->error;
        }
        $stmt->close();
    } else {
        $spaces_left = $max_spaces - $total_booked;
        $_SESSION['booking_confirmation'] = "Cannot book: Only $spaces_left spaces left for this class on the selected date.";
    }
}

$conn->close();
header('Location: booking.php');
exit();