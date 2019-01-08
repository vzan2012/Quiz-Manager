<?php
/** Controller for sign up
 */
// The Evaluation
$signup = null;

// define variables and set to empty values
$lastNameErr = $firstNameErr = $emailErr = $passwordErr = "";
$lastName = $firstName = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // validate lastname
  if (empty($_POST["lastname"])) {
    $lastNameErr = "Lastname is required";
  } else {
    $lastName = test_input($_POST["lastname"]);
    // check if lastname only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lastName)) {
      $lastNameErr = "Only letters and white space allowed"; 
    }
  }
  // validate firstname
  if (empty($_POST["firstname"])) {
    $firstNameErr = "Firstname is required";
  } else {
    $firstName = test_input($_POST["firstname"]);
    // check if firstname only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstName)) {
      $firstNameErr = "Only letters and white space allowed"; 
    }
  }
  
  // validate email
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  // validate password
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = trim($_POST["password"]);
  }

  require_once("../model/signup_model.php");
  $signup = Signup::createStudent($firstName, $lastName, $email, $password); 

} 


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Send to the view
require_once("../view/signup_view.php");

// Get id parameter
/*$evaluation_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($evaluation_id === null // no value
  || $evaluation_id == false) { // not an integer
  $errors["id"] = "id parameter must be set and integer (eg: evaluation-1)";
}
else {
  // Call the model
  require_once("../model/evaluation_model.php");

  $evaluation = Evaluation::get($evaluation_id);
}
*/
