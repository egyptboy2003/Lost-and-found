<?php
session_start();
include '../auth.php';
?>

<html>

<head>
    <title>Register</title>
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
                <h3>New Account?</h3>
                <input class="form-field" name="email" type="email" placeholder="Email">
                <input class="form-field" name="password" type="password" placeholder="Password">
                <input class="form-field" name="confirmpassword" type="password" placeholder="Confirm Password">

                <input class="form-field half-form-field" name="fname" type="text" placeholder="First Name">
                <input class="form-field half-form-field float-right" name="lname" type="text" placeholder="Last Name">
                <input class="form-field form-submit" type="submit" name="registersubmit" id="registersubmit" value="Register">
                <a id="register-link" href="login.php">Already have an account? Log in here!</a>
            </form>
            <div id='output-div'>


            <?php
            if (isset($_POST["registersubmit"])) {
                $email = $_POST["email"];
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $conf_password = $_POST["confirmpassword"];
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $query = mysqli_query($conn, "SELECT * FROM users WHERE (email = '$email')");
                if (!password_verify($conf_password, $password)) {
                    echo "Passwords do not match.";
                } else if(mysqli_num_rows($query) == 0) {
                    mysqli_query($conn, "INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`) VALUES ('$email', '$password', '$fname', '$lname')");
                    $result = mysqli_query($conn, "SELECT * FROM users WHERE (email = '$email')");
                    $_SESSION['user-id'] = mysqli_fetch_assoc($result)['ID'];
                    header('Location: index.php');
                }
            }
            $conn = null;
            ?>

            </div>
        </div>
    </div>
</body>

</html>