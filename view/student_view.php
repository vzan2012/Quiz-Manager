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

      <?php include("header_styles.php"); ?>

   </head>
   <body>
	  <?php
		// Header shared by all pages
		require_once("header.php");
      ?>

      <div class="container">  
         <table class="table table-bordered">
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
      </div>
   </body>

   <?php include("page_scripts.php"); ?>

</html>