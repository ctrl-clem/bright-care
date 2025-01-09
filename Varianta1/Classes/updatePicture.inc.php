<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_picture'])) {
    session_start();
    include "../Classes/dbh.classes.php";
    include "../Classes/profileinfo.classes.php";
    include "../Classes/profileinfo.controller.php";

    $uploadDir = '../Uploads/';
    $fileName = basename($_FILES['profile_picture']['name']);
    $uniqueFileName = uniqid() . "_" . $fileName;
    $targetFile = $uploadDir . $uniqueFileName;

    $profileInfo = new ProfileInfoController($_SESSION['userid'],$_SESSION['useruid'],"nanny");
    $profileInfo->savePicture($_SESSION['userid'],$_FILES,$targetFile);
    header("location:../NannyProfile.php");
}

