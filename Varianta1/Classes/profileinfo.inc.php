<?php

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["userid"];
    $uid = $_SESSION["useruid"];
    $role = $_SESSION["userrole"];
    if($_SESSION["userrole"] == "nanny") {
        $about = htmlspecialchars($_POST["about"], ENT_QUOTES, "UTF-8");
        $skills = htmlspecialchars($_POST["skills"], ENT_QUOTES, "UTF-8");
        $cv = htmlspecialchars($_POST["mini-cv"], ENT_QUOTES, "UTF-8");
    }
    else if($_SESSION["userrole"] == "parent") {
        $q1 = htmlspecialchars($_POST["factor"], ENT_QUOTES, "UTF-8");
        $q2 = htmlspecialchars($_POST["frequency"], ENT_QUOTES, "UTF-8");
        $q3 = htmlspecialchars($_POST["children"], ENT_QUOTES, "UTF-8");
        $q4="";
        $q5="";
        if(isset($_POST["ageGroup"]) && is_array($_POST["ageGroup"])) {
            $q = $_POST["ageGroup"];
            $qs = array_map('htmlspecialchars', $q);
            foreach ($q as $interest) {
                $q4 = $q4 . ";" . $interest;
            }
        }
        if(isset($_POST["qualifications"]) && is_array($_POST["qualifications"])) {
            $q = $_POST["qualifications"];

            foreach ($q as $interest) {
                $q5 = $q5 . ";" .  $interest;
            }
        }
        $q6 = htmlspecialchars($_POST["preferences"], ENT_QUOTES, "UTF-8");
    }

    include "../Classes/dbh.classes.php";
    include "../Classes/profileinfo.classes.php";
    include "../Classes/profileinfo.controller.php";
    $profileInfo = new ProfileInfoController($id,$uid,$role);

    if($_SESSION["userrole"] == "nanny") {
        $profileInfo->updateProfileInfo($about, $skills, $cv);
        header("location: ../NannyProfile.php?error=none");
    }
    else if($_SESSION["userrole"] == "parent") {
        $profileInfo->defaultProfileInfoParent($q1, $q2, $q3, $q4, $q5, $q6);
        header("location: ../index.php?error=none");
    }

}