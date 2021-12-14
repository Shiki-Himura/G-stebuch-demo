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
        $query = "SELECT content.*,userdata.username FROM `content` JOIN userdata ON content.user_ID WHERE content.user_ID = userdata.ID AND `post_ID` = '".$_GET['postid']."' ORDER BY ID";
        return $this->db->Execute($query);
    }

    public function GetEntryCount()
    {
        // TODO: get post count from certain user
        $query = "SELECT Count(user_ID) FROM `content` JOIN userdata ON content.user_ID WHERE content.user_ID = userdata.ID AND userdata.username = '".$_GET['username']."'";
        return $this->db->Execute($query);
    }

    public function CreateNewEntry()
    {
        $post_id = -1;
        if(isset($_SESSION['last_id']))
            $post_id = $_SESSION['last_id'];
        
        if(isset($_GET['postid']))
            $post_id = $_GET['postid'];

        $query = "SELECT `ID` FROM `userdata` WHERE `username` = '".$_SESSION['valid_user']."'";
        $result = $this->db->Execute($query);
        
        $query = "INSERT INTO `content` (`Text`,`post_ID`,`user_ID`) VALUES ('".$_REQUEST['posttext']."','".$post_id."','".$result[0]->ID."')";
        $this->db->ExecuteNonQuery($query);
    }

    public function GetCategory()
    {
        $query = "SELECT * FROM `categories` ORDER BY `orderID`";
        return $this->db->Execute($query);
    }

    public function UpdateCategoryOrderID()
    {
        $query = "UPDATE `categories` SET `orderID`=".$_REQUEST['orderid']." WHERE `Name` = ".$_REQUEST['category_name']."";
        return $this->db->ExecuteNonQuery($query);
    }
}
?>