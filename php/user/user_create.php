<?php
include '../../../auth.php';

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];
$fname = $_REQUEST["fname"];
$lname = $_REQUEST["lname"];

try {
  $conn = mysqli_connect($servername, $db_username, $db_password, $dbname);
  $query = mysqli_query($conn, "SELECT * FROM users WHERE (email = '$email')");
  if(mysqli_num_rows($query) == 0){
    mysqli_query($conn, "INSERT INTO `users` (`email`, `password`, `firstname`, `lastname`) VALUES ('$email', '$password', '$fname', '$lname')");
    echo "user created";
  } else {
    echo "already in database";
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}
$conn = null;
?>