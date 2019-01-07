<?php

// Include class DB found in DB.php
require_once("DB.php");

class Evaluation {

   /** Get the evaluation of id $id as an associative array,
    *  or null if not found */
   public static function get($id) {
      // Get a db connection
      $db = DB::getConnection();
      // Parameterized SQL query
      $sql = "
  		SELECT evaluation_id,title,diagram_path,scheduled_at,ending_at
  		FROM 
  			evaluation e
  				INNER JOIN
  			sql_quiz sq ON e.quiz_id = sq.quiz_id
              INNER JOIN
        quiz_db qd ON sq.db_name = qd.db_name
  		WHERE e.evaluation_id = :id";
      // Compile the request
      $stmt = $db->prepare($sql);
      // Set the parameter
      $stmt->bindValue(":id", $id);
      // Execute the request
      $stmt->execute();
      // Return the row as an associative array, or null if not found
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

}