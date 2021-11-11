<?php
include '../../../auth.php';

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $query = mysql_query("INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password')");
  if(mysql_num_rows($query) == 0){
    echo "user found";
  } else {
    echo ""
  }
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>