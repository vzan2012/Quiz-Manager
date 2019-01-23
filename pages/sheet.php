<?php
/** Controller for evaluation of id specified in the url (product-{id}
 * GET displays the evaluation. We should forbid other methods.
 */
session_start();
// Memorize the page to redirect to it if logging in
$_SESSION["page"] = $_SERVER["REQUEST_URI"];

// Access permitted only if user is logged in
if(!isset($_SESSION['user_sql_skills'])){
  header("Location: ./");
}

// The Sheet
$sheet = null;

// Errors
$errors = array();


// Get id parameter
$evaluation_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
//$trainee_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$trainee_id = $_SESSION["user_sql_skills"]["user_id"];

$quizId = filter_input(INPUT_GET, "quizId", FILTER_VALIDATE_INT);

if ($evaluation_id === null // no value
  || $evaluation_id == false) { // not an integer
  $errors["id"] = "id parameter must be set and integer (eg: evaluation-1)";
}
else if ($trainee_id === null || $trainee_id == false) {
  $errors["id"] = "trainee id parameter must be set and integer";
}
else {
  // Call the model
  require_once("../model/evaluation_model.php");
  

  $evaluation = Evaluation::get($evaluation_id);
  // $sheet = Sheet::getQuestions($quizId);
}

$sheet = array();

//if (count($errors) == 0) {
	require_once("../model/sheet_model.php");
	$sheet = Sheet::getQuestions($quizId);
//}

// Sent to the view
require_once("../view/sheet-student.php");
