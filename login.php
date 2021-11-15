<?php
session_start();
include '../auth.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <img id="bg-img" src="./resources/aurora.jpg">
    <div id="navbar">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="lostitems.php">LOST ITEMS</a></li>
            <li><a href="founditems.php">FOUND ITEMS</a></li>
            <li style="float:right" id="loginout">
            <?php
                if (isset($_SESSION['user-id'])) {
                    echo("<a href='logout.php'>LOGOUT</a>");
                } else {
                    echo("<a href='login.php'>LOGIN</a>");
                }
                ?>
            </li>
        </ul>
    </div>
    <div id="site-content">
        <div class="justify-center">
            <form id="login-form" method="POST" action="">
                <h3>Have an account?</h3>
                <input class="form-field" name="email" type="email" placeholder="Email" required>
                <input class="form-field" name="password" type="password" placeholder="Password" required>
                <input class="form-field form-submit" type="submit" name="login" id="loginsubmit" value="Sign In">
                <a id="register-link" href="register.php">Don't have an account? Register now!</a>
            </form>
<div id='output-div'>

<?php
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE (email = '$email')");
    if (mysqli_num_rows($result) == 0){
        echo("failed");
    } else {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user-id'] = $row['ID'];
            header('Location: index.php');
        } else {
            echo("failed");
        }
    }
}
$conn = null;
?>
</div>
        </div>
    </div>
</body>

</html>