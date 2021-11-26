<?php
session_start();
include "UserData_data.php";

class AccountManager
{
    private $account;

    public function __construct()
    {
        $this->account = new UserData_data();
    }
    
    
    public function Login()
    {
        $result = $this->account->ValidateUser();
    }

    public function Logout()
    {

    }

    public function Register()
    {

    }
}

    if($_REQUEST['key'] == "login")
    {
        $this->Login();
    }
?>