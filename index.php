<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col">
        <?php
            $user_entry = "<div id='current-user' class='fs-1'>Hey ".$_SESSION['valid_user']."!</div>";
            if(isset($_SESSION['valid_user']))
                echo($user_entry);
        ?>
    </div>
</div>
<div class="row" id="dbcontent">
    <?php
        if(isset($_GET['postid']))
            include_once 'Modules/post_content.php';
        else if(isset($_GET['category_id']))
            include_once 'Modules/posts.php';
        else
            include_once 'Modules/categories.php';
    ?>
</div>
<?php
    include_once("./Modules/footer.php");
?>
