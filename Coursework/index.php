<?php

//if the form has been submitted
if (isset($_POST['submitted'])){
  if ( !isset($_POST['email'], $_POST['password']) ) {
    // Could not get the data that should have been sent.
    exit('Please fill both the email and password fields!');
  }
  // connect DB
  require_once ("connectdb.php");
  try {
    //Query DB to find the matching username/password
    //using prepare/bindparameter to prevent SQL injection.
    $stat = $conn->prepare('SELECT password FROM users WHERE email = ?');
    $stat->execute(array($_POST['email']));

    // fetch the result row and check
    if ($stat->rowCount()>0){  // matching username
      $row=$stat->fetch();
      
      if (password_verify($_POST['password'], $row['password'])){ //matching password

        //??recording the user session variable and go to loggedin page??
        session_start();
        $_SESSION["email"]=$_POST['email'];
        header("Location:Homepage.php");
        exit();

      } else {
        ?><script> alert('Password does not match the email adress')</script><?php
      }
    } else {
      //else display an error
      echo "<p style='color:red'>Error logging in, Email not found </p>";
    }

  }
  catch(PDOException $ex) {
    echo("Failed to connect to the database.<br>");
    echo($ex->getMessage());
    exit;
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>SignIn</title>
  <link href="css/SignInlayout.css" rel="stylesheet" />
  <script src="js/validate_password.js"></script>
  <script src="js/password.js"></script>
</head>
<body>
  <center><h1>Welcome to Aston events.</h1>
    <div class="login">
      <h1>Log in</h1>
      <form method="post">
        <input type="text" name="email" placeholder="Enter your email"/><br><br><br>
        <input type="password" name="password" placeholder="Enter your password"/><br><br><br>
        <input type="submit" name="submit" value="Submit"/><br><br><br>
        <input type="hidden" name="submitted" value="true"/>
        <a class="link" href="Register.php">Create an account?</a><br>
      </form>
    </div>
  </center>
</body>
</html>
