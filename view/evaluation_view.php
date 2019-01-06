<?php
/** This page demonstrates the use of Ajax to place a bid on the displayed product.
 * With Ajax, we control the bid in a lightweight way: we control only on the
 * server side the insert in the db, and if there is an error, we just display it
 * through javascript, which avoids to request again the product details and its
 * associated bids.
 * If it is a success, and only then, we reload the page to refresh the bids.
 * This could be even lighter, in asking only the bids, without a complete reload
 * of the page.
 * The user experience could be improved by displaying the bids on a temporal layer
 * encompassing the entry date and the deadline. This would require a lot of additional
 * JS and CSS code. 
 */
// Product view
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

      <img src="http://<?php echo $_SERVER["SERVER_NAME"] ?>/quiz-manager/pages/<?php echo $evaluation["diagram_path"] ?>" /> <br/>
      <p style="line-height: 25px;">
         <strong>Title:</strong>&nbsp;<span><?php echo $evaluation["title"] ?></span><br/>
         <strong>Scheduled At:</strong>&nbsp;<span><?php echo $evaluation["scheduled_at"] ?></span><br/>
         <strong>Ending At:</strong>&nbsp;<span><?php echo $evaluation["ending_at"] ?></span><br/>
      </p>
      <p>
         <input type="submit" id="" value="Start" style="padding: 10px 20px; font-size: 15px;" />
      </p>
   </body>

</html>