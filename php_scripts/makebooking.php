<?php
session_start();//Start session to use variables in session
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Database connection variables (should be in a separate, secure file)
$servername = "localhost";
$username = "root";
$password = "root";
$database = "gymdb"
$port = 8889;

//Create a connection to teh database
$conn = new mysqli($servername, $username, $password, $database, $port);

//check connection
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

//Assume $user_id comes from a logged-in user session variable
$user_id = $_SESSION['user_id'] ??null; //Replace with actual user session variable

//Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['class'])){
}   $class_id = $_POST['class'];
    $booking_date = date('Y-m-d H:i:s'); //Current date and time

    //Insert booking into the database using prepared statements
    $stmt = $conn->prepare("INSERT INTO class_bookings(user_id, class_id, booking_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $class_id, $booking_date);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        //If booking is successful, display a message with booking details
    echo "Booking successful! Booking ID: "_. $conn->insert_id;
    }else {
      echo "Error: " . $conn->error;
    }
    $stmt->close(); //Close the statement.
    }
    echo '</pre>';

    $conn->close();//Close the database connection.
    ?>





