<?php
    session_start();
    $connection = new mysqli('localhost', 'root', '', 'gästebuch');
    if(mysqli_connect_error())
    {
        echo "Database connection failed";
        exit;
    }

    if(isset($_REQUEST['login']))
    {
        $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."' AND `password` = '".$_REQUEST['pw']."'";
        $result = $connection->query($query);
        $row = $result->fetch_object();

        if($row->usercount == 1)
        {
            $_SESSION['valid_user'] = $_REQUEST['un'];
            echo true;
        }
        else
            echo false;
    }
?>