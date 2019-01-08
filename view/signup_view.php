<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<h2>User Sign Up</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="signup">  
  FirstName: <input type="text" name="firstname" value="<?php echo $firstName;?>" required>
  <span class="error">* <?php echo $firstNameErr;?></span>
  <br><br>
  LastName: <input type="text" name="lastname" value="<?php echo $lastName;?>" required>
  <span class="error">* <?php echo $lastNameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>" required>
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password: <input type="password" name="password" value="<?php echo $password;?>" required>
  <span class="error">*<?php echo $passwordErr;?></span>
  <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>

</body>
</html>