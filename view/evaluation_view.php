<?php
// Evaluation view
// Data : $product, $bids
require_once("../model/DB.php");
?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="static/auction.css"/>
   <title>Quiz Manager - <?php echo $evaluation["diagram_path"] ?> (id <?= $evaluation["evaluation_id"] ?>)</title>
   <script src="static/jquery-1.11.2.min.js"></script>
  
   </head>
   <body>
      <form name="" method="post" action="login.php">
         <img src="http://<?php echo $_SERVER["SERVER_NAME"] ?>/quiz-manager/pages/<?php echo $evaluation["diagram_path"] ?>" /> <br/>
         <p style="line-height: 25px;">
            <strong>Title:</strong>&nbsp;<span><?php echo $evaluation["title"] ?></span><br/>
            <strong>Scheduled At:</strong>&nbsp;<span><?php echo $evaluation["scheduled_at"] ?></span><br/>
            <strong>Ending At:</strong>&nbsp;<span><?php echo $evaluation["ending_at"] ?></span><br/>
         </p>
         <p>
            <input type="submit" id="" value="Start" style="padding: 10px 20px; font-size: 15px;" />
         </p>
      </form>
   </body>

</html>