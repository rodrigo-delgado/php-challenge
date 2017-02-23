<?php

include_once 'resource/database.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    try {

      $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                    VALUES (:username, :email, :password, now())";

      $statement = $db->prepare($sqlInsert);
      $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $password));

      if ($statement->rowCount() == 1) {
          $result = "<p>Registration Successful</p>";
      }

    } catch (PDOException $ex) {
        $result = "<p>This is an Error!: ".$ex->getMessage()."</p>";
      }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register Page</title>
  </head>
  <body>
    <h1>User Authentication System</h1><hr />

    <h2>Registration Form</h2>

    <?php if (isset($result)) echo $result; ?>

    <form method="post" action="">
      <table>
        <tr>
          <td>Email:</td>
          <td><input type="text" value="" name="email"/></td>
        </tr>
        <tr>
          <td>Username:</td>
          <td><input type="text" value="" name="username"/></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" value="" name="password"/></td>
        </tr>
        <tr>
          <td><input style="float: right;" type="submit" value="Signin" /></td>
        </tr>
      </table>
    </form>

    <p><a href="index.php">Back</a></p>

  </body>
</html>
