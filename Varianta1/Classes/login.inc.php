<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid= $_POST["uid"];
    $password= $_POST["password"];

    include "../Classes/dbh.classes.php";
    include "../Classes/login.classes.php";
    include "../Classes/login.controller.php";


    $login = new LoginController($uid, $password);
    $user = $login->logInUser();
    session_start();
    $_SESSION["userid"] = $user["usersId"];
    $_SESSION["useruid"] = $user["usersUid"];
    $_SESSION["userrole"] = $user["usersRole"];
    header("location:../index.php?error=none");
}