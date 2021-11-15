<?php
session_start();
include '../auth.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lost items</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/table.css">
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
    <div id="site-content">
        <div class="table-container">
            <table>
                <tr class='table-header'>
                    <th>Name</th>
                    <th>Date Lost</th>
                    <th>Category</th>
                    <th>Value</th>
                </tr>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM lost_items");
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>
                        <th>", $row['name'], "</th>
                        <th>", $row['date_lost'], "</th>
                        <th>", $row['category'], "</th>
                        <th>", $row['value'], "</th>
                        </tr>";
                    }
                    ?>
            </table>
        </div>
    </div>
</body>

</html>