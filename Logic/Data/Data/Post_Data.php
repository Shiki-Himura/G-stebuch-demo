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
        $query = "INSERT INTO posts (`Author`,`Title`,`Description`) VALUES ('".$_SESSION['valid_user']."','".$_REQUEST['title']."','".$_REQUEST['description']."')";
        return $this->db->ExecuteNonQuery($query);
    }

    public function GetAllEntries()
    {
        $query = "SELECT * FROM `posts`";
        return $this->db->Execute($query);
    }
}
?>