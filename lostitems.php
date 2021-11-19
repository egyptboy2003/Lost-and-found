<?php
session_start();
include '../auth.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Lost items</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/items.css">
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
    <div id="items-form-container" hidden>
            <form id="items-form" method="POST" action="">
                <h3>Lost an item?</h3>
                Item Name<br>
                <input class="form-field" name="itemname" type="text" required><br>
                Date Lost<br>
                <input class="form-field" name="datelost" type="date" required><br>
                Category<br>
                <select class="form-field" name="category">
                    <option value="" selected disabled></option>
                    <option value="Jewelery">Jewelery</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Technology">Technology</option>
                    <option value="Other">Other</option>
                </select><br>
                Value<br>
                <input class="form-field" name="value" type="number" required><br>
                <input class="form-field form-submit" type="submit" name="itemsubmit" value="Submit">
            </form>
            <?php
                if (isset($_POST["itemsubmit"])) {
                    $poster_id = htmlentities($_SESSION['user-id'], ENT_QUOTES);
                    $itemname = htmlentities($_POST["itemname"], ENT_QUOTES);
                    $datelost = htmlentities($_POST["datelost"], ENT_QUOTES);
                    $category = htmlentities($_POST["category"], ENT_QUOTES);
                    $value = htmlentities($_POST["value"], ENT_QUOTES);
                    mysqli_query($conn, "INSERT INTO `lost_items` (`poster_ID`, `name`, `date_lost`, `category`, `value`) VALUES ('$poster_id', '$itemname', '$datelost', '$category', '$value')");
                }
                ?>
        </div>
    <div id="site-content">
    <?php
            if (isset($_SESSION['user-id'])) {
                echo("<a onclick=\"openContainer();\"><div class='button'><p class='button-inner-text'>ADD ITEM</p></div></a>");
            }
        ?>
        <form id='search-form' method='POST'>
            <input class='search-bar' name='search' type='text' placeholder='SEARCH'>
            <input type='submit' name='search-submit' hidden>
        </form>
        <?php
        if (isset($_POST['search-submit'])) {
            $GLOBALS['search-term'] = $_POST['search'];
        } else {
            $GLOBALS['search-term'] = '';
        } ?>
        <div class="table-container">
            <table>
                <tr class='table-header'>
                    <th>NAME</th>
                    <th>DATE LOST</th>
                    <th>CATEGORY</th>
                    <th>VALUE</th>
                </tr>
                <?php
                    $search_term = htmlentities($GLOBALS['search-term'], ENT_QUOTES);
                    if ($search_term != '') {
                        $result = mysqli_query($conn, "SELECT * FROM lost_items WHERE (name LIKE '%$search_term%')");
                    } else {
                        $result = mysqli_query($conn, "SELECT * FROM lost_items");
                    }
                    if (mysqli_num_rows($result) != 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>
                            <th>", $row['name'], "</th>
                            <th>", $row['date_lost'], "</th>
                            <th>", $row['category'], "</th>
                            <th>", $row['value'], "</th>
                            </tr>";
                        } echo("</table>");
                    } else {
                        echo("</table>");
                        echo("<p class='items-error-msg'>Search does not match any items.</p>");
                    }
                ?>
            </table>
        </div>
    </div>
</body>


</html>