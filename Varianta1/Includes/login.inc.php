<?php

if(isset($_POST["submit"])){
    $username = $_POST["uid"];
    $password = $_POST["pwd"];

    require_once "dbh.inc.php";
    require_once "functions.inc.php";
    if(isset($conn)){
        echo "success";
    }
    else{
        echo "connection error";
    }
    if(emptyInputLogIn($username,$password)!==true){
        header("location: ../LogIn.php?error=emptyinput");
        exit();
    }

    loginUser($conn,$username,$password);


}
else{
    header("location: ../LogIn.php");
    exit();
}