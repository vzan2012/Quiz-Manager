<?php

// Include class DB found in DB.php
require_once("DB.php");

class Sheet {

   /** Get the evaluation of id $id as an associative array,
    *  or null if not found */
   public static function update($traineeId, $id) {
      
      // Get a db connection
      $db = DB::getConnection();

      // Parameterized SQL query
      $sql = "UPDATE sheet 
               SET started_at = :startedAt 
               WHERE trainee_id=:traineeId and evaluation_id=:id";
      
      // Compile the request
      $stmt = $db->prepare($sql);
      // Set the parameter
      $stmt->bindValue(":startedAt", date("Y-m-d h:i:s"));
      $stmt->bindValue(":traineeId", $traineeId);
      $stmt->bindValue(":id", $id);

      // Execute the request
      $stmt->execute();
      // Return the row as an associative array, or null if not found
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }


   public static function getQuestions($quizId) {
      // Get a db connection
      $db = DB::getConnection();

      // Parameterized SQL query
      $sql = "SELECT sz.quiz_id, sqq.question_id, sq.question_text
              FROM sql_question sq
                  INNER JOIN
                     sql_quiz_question sqq ON sq.question_id = sqq.question_id
                  INNER JOIN
                     sql_quiz sz on sz.quiz_id = sqq.quiz_id
              WHERE sz.quiz_id = :quizId";
      
      // Compile the request
      $stmt = $db->prepare($sql);
      // Set the parameter
      $stmt->bindValue(":quizId", $quizId);

      // Execute the request
      $stmt->execute();

      // Return the row as an associative array, or null if not found
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}