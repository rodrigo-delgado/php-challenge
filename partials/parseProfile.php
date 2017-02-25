<?php
include_once 'resource/database.php';
include_once 'resource/utilities.php';


if((isset($_SESSION['id']) || isset($_GET['user_identity'])) && !isset($_POST['updateProfileBtn'])){
  if(isset($_GET['user_identity'])) {
    $url_encoded_id = $_GET['user_identity'];
    $decode_id = base64_decode($url_encoded_id);
    $user_id_array = explode("encodeuserid", $decode_id);
    $id = $user_id_array[1];

  } else {
    $id = $_SESSION['id'];
  }



  $sqlQuery = "SELECT * FROM users WHERE id = :id";
  $statement =$db->prepare($sqlQuery);
  $statement->execute(array(':id' => $id));

  while($rs = $statement->fetch()) {
    $username = $rs['username'];
    $email = $rs['email'];
    $date_joined = strftime("%b %d, %Y" , strtotime($rs ["join_date"]));
  }
  $encode_id = base64_decode("encodeuserid{$id}");

} elseif (isset($_POST['updateProfileBtn'])) {
  // initialize an array to store ane error message from the form
  $form_errors = array();

  //Form valudation
  $required_fields = array('email', 'username');

  //Call the function to check empty field
  $form_errors = array_merge($form_errors, check_empty_fields($requiered_fields));

  //Fields that requires checking for minimum length
  $fields_to_check_length = array('username' => 4);

  //call the function to check the minimum required length
  $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));

  //email validation
  $form_errors = array_merge($form_errors, check_email($_POST));

  //collect form data and store it in variables
  $email = $_POST['email'];
  $username = $_POST['username'];
  $hidden_id = $_POST['hidden_id'];


  if(empty($form_errors)) {
    try {
      //create SQL insert statements
      $sqlUpdate = "UPDATE users SET username =:username, email =:email WHERE id =:id";

      //use PDO prepared to sanitize data
      $statement = $db->prepare($sqlUpdate);

      //add the data into the database
      $statement->execute(array(':username' => $username, ':email' => $email, $hidden_id => ':hidden_id'));

      //check if one new row was created
      if ($statement->rowCount() == 1) {

          $result = "<script type='text/javascript'>
            swal({
                  title: 'Sweet as $username!',
                  text: 'Profile Updated Successfully',
                  type: 'success',
                  cancelButtonText: 'Sweet!'});
            </script>";
      } else {

          $result = "<script type='text/javascript'>
            swal({
                  title: 'Oh Oh, $username!',
                  text: 'You have not made any changes...',
                  type: 'error',
                  cancelButtonText: 'Cool!'});
            </script>";
        }
    } catch (PDOException $ex) {
      $result = quickMessage("An error: " .$ex->getMessage());
      }

  }
}

?>
