<?php

// initialize variables to hold connection parameters
$username = 'root';
$dsn = 'mysql:host=localhost; dbname=register';
$password = '';




try {
  //create an instance of the PDO class with the requiere parameters
  $db = new PDO($dsn, $username, $password);

  //set PDO error mode to exeption
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //display succes message
  // echo "Connected to the register database";

} catch (PDOException $ex) {
  //dispaly error message
  echo "Connection failed".$ex->getMessage();
}
?>
