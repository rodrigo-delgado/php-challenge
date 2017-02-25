<?php
$page_title = "User Authentication - Edit - Profile";

include_once 'partials/navbar.php';
include_once 'partials/parseProfile.php';

?>

<div class="container">
    <div>
      <h1>Edit Profile</h1>
      <div>
        <?php if(isset($result)) echo $result; ?>
        <?php if(!empty($form_errors)) echo show_error($form_errors); ?>
      </div>
      <div class="clearfix"></div>

      <?php if(!isset($_SESSION['username'])): ?>
        <p class="">
          Sorry mate, you are not allowed to view this page <a href="login.php">Login</a>
          Not a member yet? <a href="signup.php">Sign Up Here</a>
        </p>
    <?php else: ?>
      <form method="post" action="">

        <div class="form-group">
          <label for="emailField">Email</label>
          <input type="email" class="form-control" name="email" id="emailField" placeholder="Email"
          value="<?php if(isset($email)) echo $email; ?>">
        </div>

        <div class="form-group">
          <label for="usernameField">Username</label>
          <input type="text" name="username" class="form-control" id="usernameField" placeholder="Username"
          value="<?php if(isset($username)) echo $username; ?>">
        </div>

        <input type="hidden" name="hidden-id" value="<?php if(isset($id)) echo $id; ?>">
        <button type="submit" name="updateProfileBtn" class="btn btn-primary pull-right">Update Profile</button>

      </form><br />
    <?php endif ?>
    </div>
    <p>
        <a href="index.php"></a>
    </p>
</div>
<?php include_once 'partials/footer.php'?>
