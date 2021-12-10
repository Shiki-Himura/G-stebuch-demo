<?php include_once "./Modules/header.php"; ?>
    <div id='post-comment'>
        <?php include_once "./Logic/ContentManager.php"; ?>
    </div>
    
    <?php 
        if(isset($_SESSION['valid_user']))
            include_once "./Modules/post_submit.php";
    ?>