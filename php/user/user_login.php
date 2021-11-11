<?php
include '../../../auth.php';

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

try {
  $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);
  // set the PDO error mode to exception
  $query = mysqli_query($conn, "SELECT * FROM users WHERE (email = '$email') AND (password = '$password')");
  if(mysqli_num_rows($query) == 0){
    echo "Invalid username / password";
  } else {
    session_start();  
    $_SESSION['sess_user']=$email;
  }
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
$conn = null;
?>