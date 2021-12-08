<?php
    include_once __DIR__."/../../DB/Connection/DBManager.php";
if(!isset($_SESSION))
{
    session_start();
}

class Post_Data
{
    private $db;

    function __construct()
    {
        $this->db = new DBManager();
    }

    public function CreateNewEntry()
    {
        $query = "INSERT INTO posts (`Author`,`Title`,`Description`,`category_ID`) " 
                ."VALUES ('".$_SESSION['valid_user']."','".$_REQUEST['title']."','".$_REQUEST['description']."','".$_REQUEST['category_id']."')";
        return $this->db->ExecuteNonQuery($query);
    }

    public function GetAllEntries()
    {
        $query = "SELECT * FROM `posts` WHERE `category_ID` = '".$_REQUEST['category_id']."'";
        return $this->db->Execute($query);
    }
}
?>