<?php
$servername = "localhost";
$db_username = "jake";
$db_password = "leonoT7s";
$dbname = "lostandfound";

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('test@gmail.com', 'password')";
  $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>