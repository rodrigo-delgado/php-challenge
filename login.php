<?php
include_once 'resource/session.php';
include_once 'resource/database.php';
include_once 'resource/utilities.php';

if (isset($_POST['loginBtn'])){

  //array to hold errors
  $form_errors = array();

  //validate
  $required_fields = array('username', 'password');

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

  if(empty($form_errors)) {
    //collect form data
    $user = $_POST['username'];
    $password = $_POST['password'];

    //check if user exist in the database
    $sqlQuery = "SELECT * FROM users WHERE username = :username";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':username' => $username));

    while ($row = $statement->fetch()) {
      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];

      if(password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        //header should redirect to location
        redirectTo('index');


      } else {
          $result = quickMessage("Invalid Username or Password");
      }
    }

  } else {
    
    if(count($form_errors) == 1) {
      $result = quickMessage("There was an error in the form");
    } else {
      $result = quickMessage("There were " .count($form_errors). " errors in the form");
    }
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
  </head>
  <body>
    <h1>User Authentication System</h1><hr />

    <h2>Login Form</h2>

    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

    <form method="post" action="">
      <table>
        <tr>
          <td>Username:</td>
          <td><input type="text" value="" name="username"/></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" value="" name="password" /></td>
        </tr>
        <tr>
          <td><input style="float: right;" type="submit" name="loginBtn" value="Signin" /></td>
        </tr>
      </table>
    </form>

    <p><a href="index.php">Back</a></p>

  </body>
</html>
