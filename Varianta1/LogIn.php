<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="Styles/LogIn.css">
</head>
<body>
<section class="login-form">
<div class="login-container">

  <form action="Classes/login.inc.php" method="post">
    <h2>Log in</h2>
    <div class="input-group">
      <label for="uid">Email or username</label>
      <input type="text" name="uid" id="uid"  required>
    </div>
    <div class="input-group">
      <label for="password">Password</label>
      <input type="password" name="password" id="password"  required>
    </div>
    <button type="submit" name="submit">Log In</button>
    <p class="message">Don't have an account? </p>
    <p class="message">Sign up as a <a href="SignUp.php?role=parent"><b> Parent</b></a> or <a href="SignUp.php?role=nanny"><b>Nanny</b></a></p>
  </form>
</div>

    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "usernotfound"){
            echo "<p class='error'>User not found!</p>";
        }
        else if($_GET["error"] == "wrongpassword"){
            echo "<p class='error'>Incorrect password!</p>";
        }

        else if($_GET["error"] == "stmtfailed"){
            echo "<p class='error'>Something went wrong. Try again!</p>";
        }
    }
    ?>
</section>
</body>
</html>
