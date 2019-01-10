<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Quiz Manager - Sign Up</title>
  
  <?php include("header_styles.php"); ?>

  <style>
    .error, span.l-error {color: #FF0000;}
  </style>

</head>
<body>
  <div class="container">

    <h2>User Sign Up</h2>

    <div class="col-lg-4 col-sm-offset-4 signup-box">
      <p><span class="error">* required field</span></p>
      <form method="post" action="signup">  
        FirstName<span class="l-error">*</span> : <input class="form-control" type="text" name="firstname" value="<?php echo $firstName;?>" required>
        <span class="error"><?php echo $firstNameErr;?></span>
        <br>
        LastName<span class="l-error">*</span> : <input class="form-control" type="text" name="lastname" value="<?php echo $lastName;?>" required>
        <span class="error"><?php echo $lastNameErr;?></span>
        <br>
        E-mail<span class="l-error">*</span> : <input class="form-control" type="text" name="email" value="<?php echo $email;?>" required>
        <span class="error"><?php echo $emailErr;?></span>
        <br>
        Password<span class="l-error">*</span> : <input class="form-control" type="password" name="password" value="<?php echo $password;?>" required>
        <span class="error"><?php echo $passwordErr;?></span>
        <div class="text-center" style="margin-top: 25px;">          
          <input type="submit" name="submit" value="Submit" class="btn btn-primary" />  
        </div>
      </form>         
    </div>

  
  </div>


</body>
</html>