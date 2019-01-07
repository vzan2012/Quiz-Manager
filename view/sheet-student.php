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
   </head>
   <body>
      <table border="1">
         <thead>
            <tr>
               <th>Question ID</th>
               <th>Question</th>
            </tr>
         </thead>
         <tbody>
            <?php
            foreach ($sheet as $sh) {
               ?>
               <tr>
                  <td><?= $sh["question_id"] ?></td>
                  <td><?= $sh["question_text"] ?></td>
               </tr>
               <?php
            }
            ?>
         </tbody>
      </table>      
   </body>

</html>