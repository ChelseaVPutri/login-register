<?php 
include("connection.php");

// if(isset($_POST['login'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     // $password = md5($_POST['password']);
//     // $password_hash = password_hash($password, PASSWORD_DEFAULT);

//     $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
//     $result = $connection->query($sql);

//     if($result->num_rows > 0) {
//         session_start();
//         $row = $result->fetch_assoc();
//         $_SESSION['username'] = $row['username'];
//         header("Location: homepage.php");
//         exit();
//     } else {
//         echo "Incorrect username or password";
//     }

// }

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE username='$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        header("Location: homepage.php");
    } else {
        echo "Incorrect name or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login Page</title>
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
            <h2>Login</h2>
            <p>Don't have an account? <a href="register.php" id="sign-link">Register</a></p>

            <form action="" method="post">
            <!-- 
                if(isset($error)) {
                    foreach($error as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                }; 
             -->
                <div class="inputField">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="inputField">
                    <input type="password" id="password" name="password" placeholder="Password"required>
                </div>
                <button type="submit" name="submit" value="login">Login</button>
            </form>
        </div>
    </div>
</body>
</html>