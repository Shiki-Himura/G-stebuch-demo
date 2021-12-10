<?php
    if(!isset($_SESSION))
    {
        session_start();
    }

    if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin')
    {
        include_once "Logic/ContentManager.php";
    }
    // TODO: add admin page content to change different settings
?>