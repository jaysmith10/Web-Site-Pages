<?php
session_start(); //Ensure session start is at very beginning

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Only attempt database connection if form is submitted

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="/css_styles/flex.css">
</head>
<body>

<div class="flex-container">
    <?php
    //Display error message if it exists
    if (!empty($_SESSION['error_message'])):?>
        <p class="error-message"><?php echo $_SESSION['error_message'];
    ?></p>
        <?php
        endif;
        ?>
    <form action="/php_scripts/process_form.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username"required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="firstname">Firstname:</label>
        <input type="text" id="firstname" name="firstname"required>

        <label for="surname">Surname:</label>
        <input type="text" id="surname" name="surname"required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">

        <label for="heart-rate">Heart Rate:</label>
        <input type="number" id="heart-rate" name="heart-rate" required>

        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" required>

        <label for="gender">Gender:</label>
        <select type="text" id="gender" name="gender" required>
            <option>Male</option>
            <option>Female</option>
        </select>


        <button type="submit">Submit</button>
    </form>
</div>


</body>
</html>