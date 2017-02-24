<?php
/**
* @param $requiered_fields_array, n array containing the list of all requiered fields
* @return array, containing all errors
*/

function check_empty_fields($requiered_fields_array) {
  //initialize an array to store error message
  $form_errors = array();

  //loop through the required fields array and popular the form error array
  foreach ($requiered_fields_array as $name_of_field) {
    if(!isset($_POST[$name_of_field]) || $_POST[$name_of_field] == NULL) {
      $form_errors[] = $name_of_field . " is a required field";
    }
  }
  return $form_errors;
}

/**
* @param $fields_to_check_length, an array containing the name of fields
* ('username' => 4, 'email' => 12)
* @return array containing error messages
*/

function check_min_length ($fields_to_check_length) {

  //initialize an array to store error messages
  $form_errors = array();

  foreach ($fields_to_check_length as $name_of_field => $minimum_length_required) {
    if (strlen(trim($_POST[$name_of_field])) < $minimum_length_required) {
      $form_errors[] = $name_of_field . " is too short, must be {$minimum_length_required} characters long";
    }
  }
  return $form_errors;
}


/**
* @param $data, store a key/value pair array where key is the name of form control
* in this case 'email' and value is the input entered by the user
* @return array containing error messages
*/

function check_email($data) {
  //initialize array to store error message
  $form_errors = array();

  $key = 'email';

  //check if the email exist in data
  if (array_key_exists($key, $data)) {

    // check if the email field has a value
    if ($_POST[$key] != null) {

      // Remove all illegal charachters from email
      $key = filter_var($key, FILTER_SANITIZE_EMAIL);

      //check if input is a valid email address

      if (filter_var($_POST[$key], FILTER_VALIDATE_EMAIL) === false) {
        $form_errors[] = $key . " is not a valid email address";
      }
    }
  }
  return $form_errors;
}

function show_errors($form_errors_array) {
  $errors = "<p><ul>";

  //loop through error array and display all items in a list
  foreach ($form_errors_array as $the_error) {
    $errors .= "<li>{$the_error}</li>";
  }
  $errors .= "</ul></p>";
  return $errors;
}


function quickMessage ($message, $passOrFail = "Fail") {
  if ($passOrFail === "Pass") {
    $data = "<p class='alert alert-success'>{$message}</p>";
  } else {
    $data = "<p class='alert alert-danger>{$message}</p>";
  }
  return $data;
}

function redirectTo($page) {
  header("Location: {$page}.php");
}

function checkDuplicateEntries($table, $column_name, $value, $db) {
  try {

    $sqlQuery = " SELECT * FROM " .$table. " WHERE " .$column_name."=:$column_name";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':$column_name' => $value));

    if($row = $statement->fetch()) {
      return true;
    }
    return false;

  } catch (PDOException $ex) {
      //handle exeption
  }
}
?>
