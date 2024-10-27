<!-- 
$conn = mysqli_connect("localhost", "root", "", "tableuser");
$name = $_POST["username"];
$pass = $_POST["password"];
$query = "INSERT INTO tableuser VALUES ('$name', '$pass')";
mysqli_query($conn, $query)

 -->

<!--
session_start();

include("connection.php");
include("functions.php");

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password)){
        $query = "INSERT INTO users (user_name, password) VALUES ('$username','$password')";
        mysqli_query($connection, $query);
        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
-->

<?php
@include 'connection.php';
if(isset($_POST["submit"])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $password = $_POST['password'];
   
    $select = "SELECT * FROM users WHERE username = '$username' && password = '$password'";
    $result = mysqli_query($connection, $select);

    if(mysqli_num_rows($result) > 0) {
        $error[] = "User already exist";
    } else {
        $insert = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        mysqli_query($connection, $insert);
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Register Page</title>
</head>
<body>
    <header>
        <div class="navbar">
            <h1>WEB PROGRAMMING - TASK 3</h1>
            <nav>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </nav>
        </div>
    </header>

    <div class="formContainer">
        <div class="formBox">
            <h2>Register</h2>
            <p>Already have an account? <a href="login.php" id="sign-link">Login</a></p>

            <form method="post">
                <?php
                if(isset($error)) {
                    foreach($error as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                }; 
                ?>
                <div class="inputField">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="inputField">
                    <input type="password" id="username" name="password" placeholder="Password"required>
                </div>
                <!-- <div class="inputField">
                    <select name="user_type">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div> -->
                <button type="submit" name="submit" value="register">Register</button>
            </form>
        </div>
    </div>
</body>
</html>