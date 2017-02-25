

<?php
    $page_title ="Login Page";
    include_once 'partials/navbar.php';
    include_once 'partials/parseLogin.php';
?>

<div class="container">
  <div class="login-header">
    <h1>User Authentication System</h1><hr />
    <h2>Login Form</h2>

    <div>
      <?php if(isset($result)) echo $result; ?>
      <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
    </div>
    <div class="clearfix"> </div>

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
