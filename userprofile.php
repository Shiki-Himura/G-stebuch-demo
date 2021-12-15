<?php include_once "Modules/header.php" ?>
<?php
    //TODO: finish styling userprofile; Add name and post counter from THAT user
    if(isset($_SESSION['valid_user']))
        include_once "Logic/ContentManager.php";
    else
    {
        header("Location: login.php");
        exit();
    }
?>
<?php include_once "Modules/footer.php" ?>