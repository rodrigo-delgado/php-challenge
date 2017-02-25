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


    //collect form data and store it in variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //this does not work ask Pedro
    if(checkDuplicateEntries("users", "email", $email, $db)) {

      $result = quickMessage("Email is already taken, try another one");

    }
    //this does not work ask Pedro
    else if(checkDuplicateEntries("users", "username", $username, $db)) {

      $result = quickMessage("Username is already taken, try another one");

    }
    //check if error array is empty, if yes process form data and insert record
    else if (empty($form_errors)) {

      //hash the password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      try {
        //create SQL insert statements
        $sqlInsert = "INSERT INTO users (username, email, password, join_date)
                      VALUES (:username, :email, :password, now())";

        //use PDO prepared to sanitize data
        $statement = $db->prepare($sqlInsert);

        //add the data into the database
        $statement->execute(array(':username' => $username, ':email' => $email, ':password' => $hashed_password));

        //check if one new row was created
        if ($statement->rowCount() == 1) {

            $result = "<script type='text/javascript'>
              swal({
                    title: 'Sweet as $username!',
                    text: 'Registration Completed Successfully',
                    type: 'success',
                    cancelButtonText: 'Thanks!'});

              setTimeout(function(){
                    window.location.href = 'index.php';
                  }, 5000);
              </script>";
        }

      } catch (PDOException $ex) {

          $result = "<script type='text/javascript'>
            swal({
                  title: 'Yeah, Nah! $username!',
                  text: 'Please Try Again',
                  type: 'error',
                  cancelButtonText: 'OK!'});
            </script>";
        }
    }

}

?>
