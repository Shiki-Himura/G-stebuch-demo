<?php
    include_once("./Modules/header.php");

    if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin')
    {
        include_once "Modules/administration.php";
    }

    include_once("./Modules/footer.php");
?>