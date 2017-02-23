<?php
//add our database connection script
include_once 'resource/database.php';

//process the form if the button is click
if (isset($_POST['signupBtn'])) {

    //initialize an array to store any errors message from the form
    $form_errors = array();

    //Form validation
    $requiered_fields = array('email', 'username', 'password');

    //loop through the $requiered_fields array
    foreach ($requiered_fields as $name_of_field) {
      if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
        $form_errors[] = $name_of_field;
      }
    }
//check if error array is empty, if yes process form data and insert record
if (empty($form_errors)) {

    //collect form data and store it in variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //hash the password doesn't work
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
      //create SQL insert statements
      $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                    VALUES (:username, :email, :password, now())";

      //use PDO prepared to sanitize data
      $statement = $db->prepare($sqlInsert);

      //add the data into the database
      $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $password));

      //check if one new row was created
      if ($statement->rowCount() == 1) {
          $result = "<p>Registration Successful</p>";
      }

    } catch (PDOException $ex) {
        $result = "<p>This is an Error!: ".$ex->getMessage()."</p>";
      }
}


else {
  if (count($form_errors) == 1) {
    $result = "<p> There was 1 error in the form<br>";

    $result .= "<ul>";

    //loop through error array and display all imagecreatefromstring
    foreach($form_errors as $error) {
      $result .= "<li>{$error}</li>";
    }
    $result .= "</ul></p>";


    } else {
      $result = "<p style='color: red;'>There were " .count($form_errors). "errors in the form <br />";

      $result .= "<ul>";
      //loop through error array and display all items
      foreach ($form_errors as $error) {
        $result .= "<li>{$error}</li>";
      }
      $result .= "</ul></p>";
    }
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
          <td><input style="float: right;" name="signupBtn" type="submit" value="Signin" /></td>
        </tr>
      </table>
    </form>

    <p><a href="index.php">Back</a></p>

  </body>
</html>
