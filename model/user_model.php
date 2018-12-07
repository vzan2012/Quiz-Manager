<?php
require_once("DB.php");

/** Access to the user table.
 * Put here the methods like getBySomeCriteriaSEarch */
class User {

   /** Get user data for id $user_id
    * @param int $user_id id of the user to be retrieved
    * @return associative_array table row
    */
   public static function get($user_id) {
      $db = DB::getConnection();
      $sql = "SELECT *
              FROM user
              WHERE user_id = :user_id";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":user_id", $user_id);
      $ok = $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

   public static function getByLoginPassword($username, $password) {
      $db = DB::getConnection();
      // We should use an encoded password, like PASSWORD(password)
      // in the WHERE clause
      $sql = "SELECT *
            FROM user
            WHERE email = :email AND password = :pwd";
      $stmt = $db->prepare($sql);
      $stmt->bindValue(":email", $username);
      $stmt->bindValue(":pwd", $password);
      $ok = $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
   }

}

?>