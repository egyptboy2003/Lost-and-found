<?php
session_start();
include '../auth.php';
include 'authenticate.php'
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Lost items</title>
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="css/account.css">
        <script src='js/form_toggle.js'></script>
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
        <div class='site-content'>
            <div class='post-half' id='lost-posts'>
                <?php
                    if (isset($_SESSION['user-id'])) {
                        $poster_id = $_SESSION['user-id'];
                        $sql = "SELECT * FROM lost_items WHERE (poster_id = '$poster_id')";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) != 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['name'];
                                echo "<div class='item'><div class='name'>";
                                echo "<h5 class='item-name'>", $name, "</h5></div>";
                                echo "<div class='vert-line'></div>
                                <div class='options-container'>
                                    <a class='item-option'>Mark found</a><br>
                                    <a class='item-option'>Edit details</a><br>
                                    <a class='item-option'>Delete record</a></h5>
                                </div></div>";
                            }
                        }
                    }
                ?>
            </div>
            <div class='post-half' id='lost-posts'>
                <?php
                    if (isset($_SESSION['user-id'])) {
                        $poster_id = $_SESSION['user-id'];
                        $sql = "SELECT * FROM found_items WHERE (poster_id = '$poster_id')";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) != 0) {
                            while($row = mysqli_fetch_assoc($result)){
                                $name = $row['name'];
                                echo "<div class='item'><div class='name'>";
                                echo "<h5 class='item-name'>", $name, "</h5></div>";
                                echo "<div class='vert-line'></div>
                                <div class='options-container'>
                                    <a class='item-option'>Owner found</a><br>
                                    <a class='item-option'>Edit details</a><br>
                                    <a class='item-option'>Delete record</a></h5>
                                </div></div>";
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>