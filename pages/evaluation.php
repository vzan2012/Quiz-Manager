<?php
/** Controller for evaluation of id specified in the url (product-{id}
 * GET displays the evaluation. We should forbid other methods.
 */
session_start();

if(!isset($_SESSION['user_sql_skills'])){
   header("Location: ./");
}

// Memorize the page to redirect to it if logging in
$_SESSION["page"] = $_SERVER["REQUEST_URI"];

// The Evaluation
$evaluation = null;

// Errors
$errors = array();


// Get id parameter
$evaluation_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($evaluation_id === null // no value
  || $evaluation_id == false) { // not an integer
  $errors["id"] = "id parameter must be set and integer (eg: evaluation-1)";
}
else {
  // Call the model
  require_once("../model/evaluation_model.php");

  $evaluation = Evaluation::get($evaluation_id);
}


// Sent to the view
require_once("../view/evaluation_view.php");
