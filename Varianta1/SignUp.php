<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="Styles/SignUp.css">
</head>
<body>
<section class="signup-form">
<div class="signup-container">
  <form action="Classes/signup.inc.php" method="post">
    <h2> Sign up</h2>
    <div class="input-group">
      <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
    </div>
    <div class="input-group">
      <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
    </div>
      <div class="input-group">
          <input type="text" name="username" id="username" placeholder="Username" required>
      </div>
    <div class="input-group">
      <input type="text" name="email" id="email" placeholder="Email" required>
    </div>
    <div class="input-group">
      <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone number" required>
    </div>
      <div class="input-group">
          <input type="text" name="zip" id="zip" placeholder="Zip code" required>
      </div>
    <div class="input-group">
      <input type="password" name="password" id="password" placeholder="Password" required>
    </div>
    <div class="input-group">
      <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password" required>
    </div>

          <?php
          if(isset($_GET["role"])) {
              if($_GET["role"] == "parent") {
                  echo '<label class="radio-container">';
                  echo '<input type="radio" name="role" value="parent" checked="checked" required><span class="checkmark"></span>I am a parent.';
                  echo '      </label>';
                  echo '<label class="radio-container">';
                  echo '<input type="radio" name="role" value="nanny" required>';
                  echo  '<span class="checkmark"></span>';
                  echo 'I am a nanny.</label>';
              }
              else{
                  echo '<label class="radio-container">';
                  echo '<input type="radio" name="role" value="parent" required><span class="checkmark"></span>I am a parent.';
                  echo '      </label>';
                  echo '<label class="radio-container">';
                  echo '<input type="radio" name="role" value="nanny" checked="checked" required>';
                  echo  '<span class="checkmark"></span>';
                  echo 'I am a nanny.</label>';
              }
          }
          else{
              echo '<label class="radio-container">';
              echo '<input type="radio" name="role" value="parent" required><span class="checkmark"></span>I am a parent.';
              echo '      </label>';
              echo '<label class="radio-container">';
              echo '<input type="radio" name="role" value="nanny" required>';
              echo  '<span class="checkmark"></span>';
              echo 'I am a nanny.</label>';

          }
              ?>

    <button type="submit" name="submit">Sign up</button>
  </form>
</div>

    <?php
    if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
            echo "<p class='error'>Fill in all the required fields!</p>";
        }
        else if($_GET["error"] == "invaliduserid"){
            echo "<p class='error'>Invalid username!</p>";
        }
        else if($_GET["error"] == "invalidemail"){
            echo "<p class='error'>Invalid email!</p>";
        }
        else if($_GET["error"] == "invalidphonenumber"){
            echo "<p class='error'>Invalid phone number!</p>";
        }
        else if($_GET["error"] == "passwordsdontmatch"){
            echo "<p class='error'>Passwords do not match!</p>";
        }
        else if($_GET["error"] == "useralreadyexists"){
            echo "<p class='error'>Username already exists!</p>";
        }
        else if($_GET["error"] == "stmtfailed"){
            echo "<p class='error'>Something went wrong!</p>";
        }
        else if($_GET["error"] == "none"){
            echo "<p class='success'>Signed up successfully!</p>";
        }
    }
    ?>
</section>



</body>
</html>