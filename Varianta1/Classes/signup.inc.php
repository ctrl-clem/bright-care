<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST["firstname"];
    //htmlspecialchars($_POST["firstname"],ENT_QUOTES,'UTF-8');
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $role = $_POST["role"];
    $zip = $_POST["zip"];

    include "../Classes/dbh.classes.php";
    include "../Classes/signup.classes.php";
    include "../Classes/signup.controller.php";


    $signup = new SignupController($firstname, $lastname, $username, $email, $phonenumber, $password,$confirmpassword,$role,$zip);

    $signup->signUpUser();

    $userId = $signup->fetchUserId($username);

    include "../Classes/profileinfo.classes.php";
    include "../Classes/profileinfo.controller.php";
    $profileInfo = new ProfileInfoController($userId,$username,$role);


    if($role == "nanny"){
        $profileInfo->defaultProfileInfoNanny();
        $_SESSION["camefrom"] = 'signup';
        header("location:../QuestionnareNanny.php");
    }
    else if($role == "parent") {
        header("location:../Questionnare.php");
    }
}