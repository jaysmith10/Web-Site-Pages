<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "root";
$database = "gymdb";
$port=8889;

$conn = new mysqli($servername, $username, $password, $database, $port);

if($conn->connect_error){
    die("Connection failed:". $conn->connect_error);}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

echo $username;
echo $password;
echo 'password and username reached';
echo "<br>";

$sql = "SELECT * FROM users WHERE username = ?";

$stmt = $conn->prepare($sql);
echo 'statement reached';
echo "<br>";
echo $sql;

$stmt->bind_param("s", $username);

$stmt->execute();

$result=$stmt->get_result();
echo "Number of rows".$result->num_rows."<br>";

if($result->num_rows > 0){
    $row=$result->fetch_assoc();
    $hashedPassword = $row['password'];
    echo 'inside if statement';
    if(password_verify($password,$hashedPassword)){
        $_SESSION['user_id'] = $row['user_id'];
        echo "session id".$_SESSION['user_id'];
        header("Location:dashboard.php");
        exit();
        }else{
            echo"Invalid username or password";
        }

        }else{
            echo"Invalid username or password";
        }

$stmt->close();
}
print_r($_POST);

print_r($_POST);

echo'<pre>';
var_dump($_SESSION);
echo '</pre>';

$conn->close();
?>