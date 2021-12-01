<?php
include __DIR__."/Data/Data/UserData_data.php";
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
        if($result[0]->usercount == 1)
        {
            $_SESSION['valid_user'] = $_REQUEST['un'];
            echo true;
        }
        else
            echo false;
    }
    
    public function Logout()
    {
        session_destroy();
    }

    public function CheckAvailability()
    {
        $result = $this->account->CheckUsername();
        if($result[0]->usercount == 0)
            echo true;
        else
            echo false;
            
    }
    
    public function Register()
    {
        $this->account->CreateUser();
        echo("Successfully registered!");
    }
}
$manager = new AccountManager();
$key = $_REQUEST['key'];

if($key == "execlogin")
{
    $manager->Login();
}
if($key == "execlogout")
{
    $manager->Logout();
}
if($key == "validate")
{
    $manager->CheckAvailability();
}
if($key == "execregister")
{
    $manager->Register();
}
?>