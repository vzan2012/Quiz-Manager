<?php

// Include class DB found in DB.php
require_once("DB.php");

class Signup {

   public static function createStudent($firstName, $firstName, $email, $password) {
      // Get a db connection
      $db = DB::getConnection();
      $token = "token_$firstName";
	  $t = time();
	  $currentTime = date("Y-m-d H:i:s", $t);
	  // SQL query
      $sql = "
  		INSERT INTO user(email, pwd, name, first_name, token, created_at, validated_at, is_trainer)
  		VALUES 
  			(?, ?, ?, ?, ?, ?, ?, ?);
      // Compile the request
      $stmt = $db->prepare($sql);
	  
      // Set the parameter
      $stmt->bind_param($email, $password, $lastName, $firstName, $token, $currentTime, $currentTime, 0);
      
	  // Execute the request
	  //$stmt->execute();
      echo "Record inserted successfully";
	  //$stmt->close();
	  
   }

}