<?php include_once "Modules/header.php" ?>
<?php
    if(isset($_SESSION['valid_user']))
        include_once "Logic/ContentManager.php";
    else
    {
        header("Location: login.php");
        exit();
    }
?>
<?php include_once "Modules/footer.php" ?>