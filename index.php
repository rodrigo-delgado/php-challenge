<?php
    $page_title ="";
    include_once '/Applications/XAMPP/xamppfiles/htdocs/auth/partials/nabvar.php';
?>

 <div class="container">
   <div class="body-title">
     <h1>User Authentication System</h1><hr />
     <?php if(!isset($_SESSION['username'])): ?>

     <p>
       You are currently not sign in <a href="login.php">Login</a><br />
       Not yet a member? <a href="singup.php">Signup</a>
     </p>

   <?php else: ?>
     <p>You are logged in as <?php if(isset($_SESSION['username'])); ?> <a href="logout.php">Logout</a></p>
   <?php endif ?>

   </div>
 </div>

<?php include_once '/Applications/XAMPP/xamppfiles/htdocs/auth/partials/footer.php'; ?>

  </body>
</html>
