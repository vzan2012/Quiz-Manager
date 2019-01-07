<?php

// Include class DB found in DB.php
require_once("DB.php");

class Sheet {

   /** Get the evaluation of id $id as an associative array,
    *  or null if not found */
   public static function update($traineeId, $evalId) {
      
      // Get a db connection
      $db = DB::getConnection();

      // Parameterized SQL query
      $sql = "UPDATE sheet SET started_at = :startedAt WHERE trainee_id=:traineeId and evaluation_id=:evalId";
      
      // Compile the request
      $stmt = $db->prepare($sql);
      // Set the parameter
      $stmt->bindValue(":startedAt", date("Y-m-d h:i:s"));
      $stmt->bindValue(":traineeId", $traineeId);
      $stmt->bindValue(":evalId", $evalId);

      // Execute the request
      $stmt->execute();
      // Return the row as an associative array, or null if not found
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public static function getQuestions($quizId) {

   }

}