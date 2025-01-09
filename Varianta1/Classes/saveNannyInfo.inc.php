<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $type = $_POST["job-type"];
    $experience = $_POST["experience"];
    $price = $_POST["hourly-rate"];
    session_start();
    include "../Classes/dbh.classes.php";
    include "../Classes/profileinfo.classes.php";
    include "../Classes/profileinfo.controller.php";

    $profileInfo = new ProfileInfoController($_SESSION['userid'],$_SESSION['useruid'],"nanny");

    $profileInfo->saveNannyInfo($_SESSION['userid'],$type,$experience,$price);
    $_SESSION['camefrom'] = 'signup';
    header("location:../ProfileSettings.php");
}