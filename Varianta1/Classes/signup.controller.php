<?php

class SignupController extends Signup {
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $phone;
    private $password;
    private $confirmPassword;

    private $role;

    private $zip;



    public function __construct($firstname, $lastname, $username, $email, $phone, $password, $confirmPassword, $role,$zip) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
        $this->role = $role;
        $this->zip = $zip;
    }

    function signUpUser(){
        if($this->emptyInput()){
            header("location: ../SignUp.php?error=emptyinput");
            exit();
        }

        if($this->invalidUserId() !==false){
            header("location: ../SignUp.php?error=invaliduserid");
            exit();
        }

        if($this->invalidEmail() !==false){
            header("location: ../SignUp.php?error=invalidemail");
            exit();
        }

        if($this->pwdMatch() !==false){
            header("location: ../SignUp.php?error=passwordsdontmatch");
            exit();
        }


        if($this->userExists() !==false){
            header("location: ../SignUp.php?error=useralreadyexists");
            exit();
        }

        $this->setUser($this->firstname,$this->lastname,$this->username,$this->email,$this->phone,$this->password,$this->role,$this->zip);
        session_start();
        $_SESSION["useruid"] = $this->username;
        $_SESSION["userid"] = $this->fetchUserId($this->username);
        $_SESSION["userrole"] = $this->role;

    }
    private function emptyInput(){
        $result=true;
        if(empty($this->zip)||empty($this->firstname) || empty($this->lastname) || empty($this->email) || empty($this->username) || empty($this->confirmPassword) ||  empty($this->phonenumber) || empty($this->password) || empty($this->role)){
            $result=false;
        }
        return $result;
    }

    private function invalidUserId(){
        $result=false;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->username)){
            $result=true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result=false;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result=true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result=false;
        if($this->password !== $this->confirmPassword){
            $result=true;
        }

        return $result;
    }

    private function userExists(){
        $result=false;
        if($this->checkUser($this->username, $this->email)){
            $result=true;
        }

        return $result;
    }

    public function fetchUserId($uid){
        $userId = $this->getUserId($uid);

        return $userId[0]["usersId"];
    }



}
