<?php
// Evaluation view
// Data : $product, $bids
require_once("../model/DB.php");
?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="static/auction.css"/>
   <title>Quiz Manager - List of Questions</title>

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
                  <th>Question ID</th>
                  <th>Question</th>
                  <th>Answer</th>
               </tr>
            </thead>
            <tbody>
               <?php
               foreach ($sheet as $sh) {
                  ?>
                  <tr>
                     <td><?= $sh["question_id"] ?></td>
                     <td><?= $sh["question_text"] ?></td>
                     <td>
                        <textarea name="" id="" cols="35" rows="5"></textarea>
                     </td>
                  </tr>
                  <?php
               }
               ?>
            </tbody>
         </table>  
      </div>

      <?php include("page_scripts.php"); ?>


   </body>

</html>