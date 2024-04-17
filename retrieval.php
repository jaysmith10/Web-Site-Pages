<?php
//class retrieval.php//

session_start();

if(!isset($_SESSION['user_id'])){
    header('Location:login.php');
    exit();
}
//Checks if the query was successful and returned rows: This line checks two things: whether the query successfully executed ($result is truthy) and whether any rows were returned ($result->num_rows > 0). Where the num_rows was greater than 0, in other words, classes were found//
$servername = "localhost";
$username = "root";
$password = "root";
$database = "gymdb";
$port = 8889;

$conn = new mysqli ($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$result = $conn->query("SELECT class_id, class_name FROM gym_classes");
$classOptions = '';

// Check if the result set has rows and then populate the options string
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Use htmlspecialchars to escape any special characters in the class_name
        $classOptions .= "<option value='" . $row['class_id'] . "'>" . htmlspecialchars($row['class_name']) . "</option>";
    }
} else {
    $classOptions .= "<option>No classes available</option>";
}

$conn->close();
?>