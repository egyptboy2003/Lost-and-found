<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lost items</title>
    <link rel="stylesheet" href="css/header.css">
</head>

<body>
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
</body>

</html>