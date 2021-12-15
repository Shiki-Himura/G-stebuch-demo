<?php
    include_once __DIR__."/Data/Data/UserData_data.php";
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
        exit();
    }
    
    public function Logout()
    {
        session_destroy();
        exit();
    }

    public function ValidateAvailability()
    {
        $result = $this->account->CheckUsername();
        if($result[0]->usercount == 0)
            echo true;
        else
            echo false;
        exit();
    }

    public function ValidateAvailabilityForUserProfiles($username)
    {
        $result = $this->account->CheckUsernameForUserProfile($username);
        if($result[0]->usercount == 0)
            return false;
        else
            return true;
    }
    
    public function Register()
    {
        $this->account->CreateUser();
        echo("Success");
        exit();
    }
}
$manager = new AccountManager();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "execlogin")
    $manager->Login();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "execlogout")
    $manager->Logout();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "validate")
    $manager->ValidateAvailability();

if(isset($_REQUEST['key']) && $_REQUEST['key'] == "execregister")
    $manager->Register();
?>