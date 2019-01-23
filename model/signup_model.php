<?php

// Include class DB found in DB.php
require_once("DB.php");

class Signup {

   public static function createStudent($firstName, $lastName, $email, $password) {
      // Get a db connection
      $db = DB::getConnection();
      $token = "token_$firstName";
  	  $t = time();
  	  $currentTime = date("Y-m-d H:i:s", $t);

      $isTrainer = 0;

      $data = [
          'email' => $email,
          'password' => $password,
          'lastName' => $lastName,
          'firstName' => $firstName,
          'token' => $token,
          'currentTime' => $currentTime,
          'isTrainer' => $isTrainer
      ];

	  // SQL query
      $sql = "
  		INSERT INTO user(email, pwd, name, first_name, token, created_at, validated_at, is_trainer)
  		VALUES 
  			(:email, :password, :lastName, :firstName, :token, :currentTime, :currentTime, :isTrainer)";

      // Compile the request

      $stmt = $db->prepare($sql);
	    $stmt->execute($data); 
      
	  // Execute the request
	  //$stmt->execute();

      echo "<h3 style='color:green; border:1px dashed green; padding: 10px;'>Record inserted successfully</h3>";
	  //$stmt->close();
	  
   }

}