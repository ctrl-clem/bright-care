<?php

class LoginController extends Login{
    private $uid;
    private $password;


    public function __construct($uid,$password)
    {
        $this->uid = $uid;
        $this->password = $password;
    }

    function logInUser()
    {
        return $this->getUser($this->uid,$this->password);

    }






}
