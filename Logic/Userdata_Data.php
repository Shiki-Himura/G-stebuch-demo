<?php

class UserData_data
{

    public function ValidateUser()
    {
        if(mysqli_connect_error())
        {
            echo "Database connection failed";
            exit;
        }

        if(isset($_REQUEST['execlogin']))
        {
            $query = "SELECT COUNT(*) AS usercount FROM userdata WHERE `username` = '".$_REQUEST['un']."' AND `password` = '".$_REQUEST['pw']."'";
            $result = $this->account->Execute($query);
        
            if($result[0]->usercount == 1)
            {
                $_SESSION['valid_user'] = $_REQUEST['un'];
                echo true;
            }
            else
                echo false;
        }
    }
}
?>