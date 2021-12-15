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
            $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."' AND `password` = '".$_REQUEST['pw']."'";
            $result = $this->db->Execute($query);
            
            return $result;
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
            $query = "INSERT INTO userdata (`username`, `password`) VALUES ('".$_REQUEST['un']."','".$_REQUEST['pw']."')";
            $this->db->Execute($query);
        }
    }
}
?>