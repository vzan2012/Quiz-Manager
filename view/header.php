<?php

/** Display error of key $key if there is one, in a $tag element
 * If $tag is not set, it defaults to span.
 */
// Display Error
function display_error($key, $tag = "span") {
   // Use the variable set outside the function
   global $errors;
   if (isset($errors[$key])) {
      print "<$tag class='alert alert-danger fadeOut login-error' role='alert'>$errors[$key]</$tag>";
   }
}
?>
<nav class="navbar navbar-inverse">
   <div class="container-fluid">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand hide" href="#">Brand</a>
      </div>
   </div>
   
   <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">   
         <li><a href="./">Home</a></li>
         <li><a href="login">Login</a></li>
         <li><a href="../doc/">Documentation</a></li>
      </ul>
   <?php
   if (isset($_SESSION["user_sql_skills"])) {
      // Connected => may disconnect
      ?>
      <form class="navbar-form navbar-right" action="sign_out" method="POST" id="loginForm">
         <button type="submit">Disconnect
            <?= $_SESSION["user_sql_skills"]["email"] ?></button>
      </form>
      <?php
   } else {
      $login = filter_input(INPUT_POST, "login");
      // Not connected => login form, with the potential error message
      ?>
      <form class="navbar-form navbar-right" action="sign_in" method="POST" id="loginForm">
         <input class="form-control" type="text" name="login" value="<?= $login ?>" placeholder="Your email" title="Your email"/>
         <input class="form-control" type = "password" name = "password" placeholder="Your password" title="Your password"/>
         <button class="btn btn-primary"type="submit">Connect</button>
         <?= display_error("login_form", "div") ?>        
      </form>
      <?php
   }
   ?>
</nav>