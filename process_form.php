<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $servername = "localhost";//variable will be used later to specify the MySql servers address (port8888)//
    $username = "root"; //Variable username store MySql database username
    $password = "root";
    $database = "gymdb";
    $port = 8889;
    $conn = new mysqli($servername,$username, $password, $database, $port );




    if($conn->connect_error){
       die("Connection failed: " . $conn->connect_error);

       }

    echo "test" ;
  $user_id = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $firstname = $_POST["firstname"];
        $surname = $_POST["surname"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $age = $_POST["age"];
        $weight = $_POST["weight"];
        $heartrate = $_POST["heart-rate"];

        $email = $_POST["email"];
        $mobile = $_POST["mobile"];




        $sql = "INSERT INTO users(username, firstname, surname, age, password, weight, heartrate, email, mobile )
        VALUES('$username','$firstname', '$surname','$age', '$password','$weight', '$heartrate','$email', '$mobile')";


        if ($conn->query($sql) === TRUE) {
       $user_id = $conn->insert_id;
        echo "Registration successful! User ID : $user_id";

    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    }


    $conn->close();






echo "help";
?>