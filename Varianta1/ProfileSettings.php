<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="Styles/ProfileSettings.css">
</head>
<?php
include_once "header.php";

include "Classes/dbh.classes.php";
include "Classes/profileinfo.classes.php";
include "Classes/profileinfo.controller.php";
include "Classes/profileinfo.view.php";
$profileInfo = new ProfileInfoView();



?>
<body>
<div class="container">
    <form action="Classes/profileinfo.inc.php" method="post">
        <?php
        if(isset($_SESSION['camefrom'])&& $_SESSION['camefrom']=='signup'){
            echo "<h1>Let's build your profile!</h1>";
            unset($_SESSION['camefrom']);
        }
        else{
            echo "<h1>Profile Settings</h1>";
        }
        ?>

        <label for="about">Profile Bio:</label>
        <textarea id="about" name="about" placeholder="Enter your bio here..."><?php $profileInfo->fetchAbout($_SESSION["userid"]); ?></textarea>
        <label for="skills">Skills:</label>
        <textarea id="skills" name="skills" placeholder="Enter skills (e.g: CPR training)"><?php $profileInfo->fetchSkills($_SESSION["userid"]); ?></textarea>
        <label for="mini-cv">Mini-CV:</label>
        <textarea id="mini-cv" name="mini-cv" placeholder="Write a short description about your background with babysitting
(e.g.: 2020-2024 : Social worker for underpriviledged kids
2018-2020 : Nanny for 3 kids aged between 5-7 years old)"><?php $profileInfo->fetchCV($_SESSION["userid"]); ?></textarea>
        <button type="submit" name="submit">Save Changes</button>
    </form>
</div>
</body>
</html>
