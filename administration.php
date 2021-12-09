<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col">
        <?php
            $admin_settings = "<div id='current-user' class='fs-1'>Na, wieder am rumspielen ".$_SESSION['valid_user']."?</div>";
            
                // TODO: add admin page content to change different settings
            if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin')
                echo($admin_settings);
                include_once "Logic/ContentManager.php";
        ?>
    </div>
</div>
<?php
    include_once("./Modules/footer.php");
?>