<?php
include __DIR__."/../../DB/Connection/DBManager.php";
if(!isset($_SESSION))
{
    session_start();
}

class Content_Data
{
    private $db;

    function __construct()
    {
        $this->db = new DBManager();
    }

    public function GetAllEntriesSortByPostID()
    {
        $query = "SELECT * FROM `content` WHERE `post_ID` = '".$_GET['postid']."'";
        return $this->db->Execute($query);
    }

    public function CreateNewEntry()
    {
        $id = -1;
        if(isset($_SESSION['last_id']))
            $id = $_SESSION['last_id'];
        
        if(isset($_GET['postid']))
            $id = $_GET['postid'];

        $query = "INSERT INTO `content` (`Name`,`Text`,`post_ID`) VALUES ('".$_SESSION['valid_user']."','".$_REQUEST['posttext']."','".$id."')";
        $this->db->ExecuteNonQuery($query);
    }

    public function GetCategory()
    {
        $query = "SELECT * FROM `categories`";
        return $this->db->Execute($query);
    }
}
?>