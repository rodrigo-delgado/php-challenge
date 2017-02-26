<?php

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
    $statement->execute(array(':username' => $user));

    while ($row = $statement->fetch()) {
      $id = $row['id'];
      $hashed_password = $row['password'];
      $username = $row['username'];


      if(password_verify($password, $hashed_password)) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;

        $result = "<script type='text/javascript'>
                  swal({
                        title: 'Welcome back $username!',
                        text: 'I will close in 5 seconds.',
                        timer: 5000,
                        type: 'success',
                        showConfirmButton: false });

                        setTimeout(function(){
                        window.location.href = 'index.php';
                        }, 5000);

                    </script>";


      } else {
        $result = "<script type='text/javascript'>
                swal({
                title: 'Yeah, Nah!',
                text: 'Please Try Again',
                type: 'error',
                cancelButtonText: 'OK!'});
                </script>";
    }

  }
  }
}
?>
