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

    public function GetAllEntriesSortDesc()
    {
        $query = "SELECT * FROM `content` ORDER BY ID DESC";
        return $this->db->Execute($query);
    }

    public function CreateNewEntry()
    {
        $query = "INSERT INTO `content` (`Name`,`Text`,`post_ID`) VALUES ('".$_SESSION['valid_user']."','".$_REQUEST['posttext']."','".$_SESSION['last_id']."')";
        $this->db->ExecuteNonQuery($query);
    }
}
?>