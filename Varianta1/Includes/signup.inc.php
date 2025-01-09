<?php

if(isset($_POST["submit"])){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $phonenumber = $_POST["phonenumber"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(isset($conn)){
        echo "success";
    }
    else{
        echo "connection error";
    }

    if(emptyInputSignup($firstname,$lastname,$username,$email,$phonenumber,$password,$confirmpassword)!==true){
        header("location: ../SignUp.php?error=emptyinput");
        exit();
    }

    if(invalidUserId($username)!==false){
        header("location: ../SignUp.php?error=invaliduserid");
        exit();
    }

    if(invalidEmail($email)!==false){
        header("location: ../SignUp.php?error=invalidemail");
        exit();
    }
//    if(invalidPhone($phonenumber)!==false){
//        header("location: ../SignUp.php?error=invalidphone");
//        exit();
//    }

    if(pwdMatch($password,$confirmpassword)!==false){
        header("location: ../SignUp.php?error=passwordsdontmatch");
        exit();
    }

    if(userExists($conn, $username,$email)!==false){
        header("location: ../SignUp.php?error=useralreadyexists");
        exit();
    }

    createUser($conn, $firstname, $lastname, $username,$email, $phonenumber, $password);

}
else{
    header("location: ../SignUp.php");
}