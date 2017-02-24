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

<?php
    $page_title ="Login Page";
    include_once '/Applications/XAMPP/xamppfiles/htdocs/auth/partials/nabvar.php';
?>
<div class="container">
  <div class="login-header">
    <h1>User Authentication System</h1><hr />
    <h2>Login Form</h2>

    <?php if(isset($result)) echo $result; ?>
    <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>

    <div class="col-xs-6 col-md-4">
      <form method="post" action="">

        <div class="login-form">
          <label for="usernameField">Username</label>
          <input type="text" class="form-control" name="username" id="usernameField" placeholder="Username">
        </div>

        <div class="form-group">
          <label for="passwordField">Password</label>
          <input type="password" name="password" class="form-control" id="passwordField" placeholder="Password">
        </div>

        <div class="checkbox">
          <label>
            <input name="remember" type="checkbox"> Remember Me
          </label>
        </div>

        <button type="submit" name="loginBtn" class="btn btn-primary pull-right">Submit</button>
      </form><br />
      <p class="login-back"><a href="index.php">Back</a></p>
    </div>
  </div>
</div>
<?php include_once '/Applications/XAMPP/xamppfiles/htdocs/auth/partials/footer.php'; ?>
  </body>
</html>
