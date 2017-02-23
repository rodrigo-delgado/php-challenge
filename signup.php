<?php
//add our database connection script
include_once 'resource/database.php';
include_once 'resource/utilities.php';

//process the form if the button is click
if (isset($_POST['signupBtn'])) {

    //initialize an array to store any errors message from the form
    $form_errors = array();

    //Form validation
    $requiered_fields = array('email', 'username', 'password');

    //Call the function to check empty field
    $form_errors = array_merge($form_errors, check_empty_fields($requiered_fields));

    //Fields that requires checking for minimum length
    $fields_to_check_length = array('username' => 4, 'password' => 6);

    //call the function to check the minimum required length
    $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

    //email validation
    $form_errors = array_merge($form_errors, check_email($_POST));


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
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

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
          <td><input style="float: right;" name="signupBtn" type="submit" value="Submit" /></td>
        </tr>
      </table>
    </form>

    <p><a href="index.php">Back</a></p>

  </body>
</html>
