<?php
$page_title = "User Authentication - Profile";

include_once 'partials/navbar.php';
include_once 'partials/parseProfile.php';

?>

<div class="container">
    <div>
      <h1>Profile</h1>
      <?php if(!isset($_SESSION['username'])): ?>
        <p class="">
          Sorry mate, you are not allowed to view this page <a href="login.php">Login</a>
          Not a member yet? <a href="signup.php">Sign Up Here</a>
        </p>
    <?php else: ?>
        <section>
          <table class="table-bordered table-condensed">
            <tr><th>Username:</th><td><?php if(isset($username)) echo $username; ?></td></tr>
            <tr><th>Email:</th><td><?php if(isset($email)) echo $email; ?></td></tr>
            <tr><th>Date Joined:</th><td><?php if(isset($date_joined)) echo $date_joined; ?></td></tr>
            <tr><th></th><td><a class="pull-right" href="edit-profile.php?user_identity=<?php if(isset($encode_id)) echo $encode_id; ?>">>
            <span class="glyphicon glyphicon-edit"></span> Edit Profile </a></td></tr>
          </table>
        </section>
    <?php endif ?>
    </div>
</div>
<?php include_once 'partials/footer.php'?>
