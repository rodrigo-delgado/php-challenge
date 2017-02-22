<?php


$username = 'root';
$dsn = 'mysql:host=localhost; dbname=register';
$password = '';




try {
  $db = new PDO($dsn, $username, $password);

  echo "Connected to the register database";

} catch (PDOException $ex) {
  echo "Connection failed".$ex->getMessage();
}
?>
