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
   </body>

</html>