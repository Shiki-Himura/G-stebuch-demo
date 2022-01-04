<?php
    include_once __DIR__."/../../DB/Connection/DBManager.php";
    if(!isset($_SESSION))
        session_start();
class UserData_data
{
    private $db;

    function __construct()
    {
        $this->db = new DBManager();
    }

    public function ValidateUser()
    {
        if(mysqli_connect_error())
        {
            echo "Database connection failed";
            exit;
        }
        if(isset($_REQUEST['key']))
        {
            $password = $_REQUEST['pw'];
            $query = "SELECT password FROM userdata WHERE `username` = '".$_REQUEST['un']."'";
            $result = $this->db->Execute($query);
            
            if(password_verify($password, $result[0]->password))
            {
                $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."' AND `password` = '".$result[0]->password."'";
                $result = $this->db->Execute($query);
                
                return $result;
            }
        }
    }

    public function CheckUsername()
    {
        $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."'";
        $result = $this->db->Execute($query);

        return $result;
    }

    public function CheckUsernameForUserProfile($username)
    {
        $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$username."'";
        $result = $this->db->Execute($query);

        return $result;
    }

    public function CreateUser()
    {
        if(mysqli_connect_error())
        {
            echo "Database connection failed";
            exit;
        }
        if(isset($_REQUEST["key"]))
        {
            $password = $_REQUEST['pw'];
            $hashed_pw = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO userdata (`username`, `password`) VALUES ('".$_REQUEST['un']."','".$hashed_pw."')";
            $this->db->Execute($query);

        }
    }
}
?>