<?php include_once "Modules/header.php" ?>
<?php
    //TODO: finish styling userprofile; Add name and post counter from THAT user
    $userprofile = "
    <div class='d-flex flex-column mt-5 text-white'>
        <h1><u>Profile</u></h1>
        <div class='fs-4'>Username: </div>
        <div class='fs-4'>Posts: </div>
    </div>";

    if(isset($_SESSION['valid_user']))
        echo($userprofile);
    else
    {
        header("Location: login.php");
        exit();
    }
?>
<?php include_once "Modules/footer.php" ?>