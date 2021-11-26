<?php
    $connection = new mysqli('localhost', 'root', '', 'gästebuch');
    if(mysqli_connect_error())
    {
        echo "Database connection failed";
        exit;
    }

    if($_REQUEST['check']=="check")
    {
        $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."'";
        $result = $connection->query($query);
        $row = $result->fetch_object();

        if($row->usercount == 1)
            echo false;
        else
            echo true;
    }

    if($_REQUEST['check']=="register")
    {
        $query = "INSERT INTO userdata (`username`, `password`) VALUES ('".$_REQUEST['un']."','".$_REQUEST['pw']."')";
        $result = $connection->query($query);
    }
?>