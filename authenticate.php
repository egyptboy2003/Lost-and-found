<?php
if(!isset($_SESSION['user-id'])) {
    header('Location: index.php');
}
?>