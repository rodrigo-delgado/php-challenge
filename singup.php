

<?php
    $page_title ="Register Page";
    include_once 'partials/navbar.php';
    include_once 'partials/parseSignup.php';
?>

<div class="container">
  <div class="login-header">
    <h1>User Authentication System</h1><hr />
    <h2>Register Form</h2>

    <div>
      <?php if(isset($result)) echo $result; ?>
      <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    </div>
    <div class="clearfix"> </div>

    <div class="col-xs-6 col-md-4">
      <form method="post" action="">

        <div class="login-form">
          <label for="emailField">Email</label>
          <input type="email" class="form-control" name="email" id="emailField" placeholder="Email">
        </div>

        <div class="form-group">
          <label for="usernameField">Username</label>
          <input type="text" name="username" class="form-control" id="usernameField" placeholder="Username">
        </div>

        <div class="form-group">
          <label for="passwordField">Password</label>
          <input type="password" name="password" class="form-control" id="passwordField" placeholder="Password">
        </div>

        <button type="submit" name="signupBtn" class="btn btn-primary pull-right">Submit</button>
      </form><br />
      <p class="login-back"><a href="index.php">Back</a></p>
    </div>
  </div>
</div>
<?php include_once '/Applications/XAMPP/xamppfiles/htdocs/auth/partials/footer.php'; ?>
  </body>
</html>
