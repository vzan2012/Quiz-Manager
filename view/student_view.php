<?php

$quiz = array();
$quiz["quiz_id"] = 1;
$quiz["title"] = "Bank Quiz";
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="static/auction.css"/>
		<title>Student View</title>
		<script src="static/jquery-1.11.2.min.js"></script>
		<!-- Bootstrap Styles -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
		<!-- Custom Styles -->
		<link rel="stylesheet" href="../pages/static/css/custom-styles.css" />
   </head>
   <body>
	  <?php
		// Header shared by all pages
		require_once("header.php");
      ?>
      <table border="1">
         <thead>
            <tr>
               <th>Quiz Id</th>
               <th>Quiz Name</th>
            </tr>
         </thead>
         <tbody>
               <tr>
                  <td><?= $quiz["quiz_id"] ?></td>
                  <td><a href="./evaluation-1"><?= $quiz["title"] ?></a></td>
               </tr>
               
         </tbody>
      </table>      
   </body>

</html>