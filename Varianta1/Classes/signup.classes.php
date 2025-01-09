<?php

class Signup extends Dbh {

    function setUser($firstname, $lastname, $username,$email, $phonenumber, $password,$role,$zip) {

        $stmt = $this->connect()->prepare("INSERT INTO users(usersFirstName,usersLastName,usersUid,usersEmail,usersPhone, usersPassword,usersRole,zipCode) VALUES (?,?,?,?,?,?,?,?) ;");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute([$firstname, $lastname, $username,$email, $phonenumber, $hashedPassword,$role,$zip])){
            $stmt = null;
            header("location: ../SignUp.php?error=stmtfailed");
            exit();
        }
        $stmt = null;


    }
    function checkUser($username,$email) {

        $sql = "SELECT * FROM users WHERE usersUid=? OR usersEmail=?;";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute([$username,$email])){
            $stmt = null;
            header("location: ../SignUp.php?error=stmtfailed");
            exit();
        }

        $result=false;
        if($stmt->rowCount() > 0){
            $result = true;
        }

        return $result;
    }

    protected function getUserId($uid){
        $stmt = $this->connect()->prepare("SELECT usersId FROM `users` WHERE `usersUid` = ?;");

        if(!$stmt->execute([$uid])){
            $stmt = null;
            header('location: NannyProfile.php?error=stmtfailed');
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: NannyProfile.php?error=profilenotfound');
            exit();
        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;

    }

}