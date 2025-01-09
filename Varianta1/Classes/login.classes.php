<?php

class Login extends Dbh {

    function getUser($uid,$password) {

        $stmt = $this->connect()->prepare("SELECT usersPassword FROM users WHERE usersUid = ? OR usersEmail = ?;");


        if(!$stmt->execute([$uid,$uid])){
            $stmt = null;
            header("location: ../LogIn.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../LogIn.php?error=usernotfound");
            exit();
        }

        $hashedPassword = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!password_verify($password, $hashedPassword[0]['usersPassword'])) {
            $stmt = null;
            header("location: ../LogIn.php?error=wrongpassword");
            exit();
        }
        else  {
            $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usersUid = ? OR usersEmail = ? AND usersPassword = ?;");

            if(!$stmt->execute([$uid,$uid,$password])){
                $stmt = null;
                header("location: ../LogIn.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../LogIn.php?error=usernotfound");
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);


            return $user[0];

        }

        $stmt = null;

    }

    function getUserRole($uid){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;");
        if(!$stmt->execute([$uid,$uid])){
            $stmt = null;
            header("location: ../LogIn.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../LogIn.php?error=usernotfound");
            exit();
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user[0]["usersRole"];
    }

    function getUsername($uid){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;");
        if(!$stmt->execute([$uid,$uid])){
            $stmt = null;
            header("location: ../LogIn.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../LogIn.php?error=usernotfound");
            exit();
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user[0]["usersUid"];
    }
    function getUserId($uid){
        $stmt = $this->connect()->prepare("SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;");
        if(!$stmt->execute([$uid,$uid])){
            $stmt = null;
            header("location: ../LogIn.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../LogIn.php?error=usernotfound");
            exit();
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user[0]["usersId"];
    }

}