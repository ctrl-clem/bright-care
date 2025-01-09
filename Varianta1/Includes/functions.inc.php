<?php

function emptyInputSignup($firstname,$lastname,$username,$email,$phonenumber,$password,$passwordrepeat){

    $result=true;
    if(empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($passwordrepeat) ||  empty($phonenumber) || empty($password)){
        $result=false;
    }
    return $result;
}

function emptyInputLogIn($username,$password){

    $result=true;
    if( empty($username) || empty($password)){
        $result=false;
    }
    return $result;
}

function invalidUserId($username){
    $result=false;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        $result=true;
    }
    return $result;
}

function invalidEmail($email){
    $result=false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }

    return $result;

}



function pwdMatch($password,$passwordrepeat){
    $result=false;
    if($password !== $passwordrepeat){
        $result=true;
    }

    return $result;
}

function userExists($conn, $username,$email){
    $sql = "SELECT * FROM users WHERE usersUid=? OR usersEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../SignUp.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function createUser($conn, $firstname, $lastname, $username,$email, $phonenumber, $password){
    $sql = "INSERT INTO users(usersFirstName,usersLastName,usersUid,usersEmail,usersPhone, usersPassword) VALUES (?,?,?,?,?,?) ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../SignUp.php?error=stmtfailed");
        exit();
    }

    $hashedPassword  = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $firstname,$lastname,$username, $email,$phonenumber,$hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../SignUp.php?error=none");
    exit();
}

function loginUser($conn, $username, $password){
    $uidExists = userExists($conn, $username,$username);

    if(!($uidExists !== false)){
        header("location: ../LogIn.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists['usersPassword'];

    if(password_verify($password, $pwdHashed)==false){
        header("location: ../LogIn.php?error=wronglogin");
        exit();
    }
    else{
        session_start();
        $_SESSION["userid"] = $uidExists['usersId'];
        $_SESSION["useruid"] = $uidExists['usersUid'];
        header("location: ../index.php");
        exit();

    }
}
