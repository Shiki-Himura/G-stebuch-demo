<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col">
        <?php
            $user_entry = "<div id='current-user' class='fs-1'>Welcome ".ucwords($_SESSION['valid_user'])."!</div>";
            if(isset($_SESSION['valid_user']))
                echo($user_entry);
            else
                echo "<div id='current-user' class='fs-3'>
                        Welcome to the Forum Guest!
                      </div>";
        ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <?php
            if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin')
            {
                echo("  <div class='fs-6 fw-bold btn btn-dark'>
                            <a href='admin-settings.php?Administration=admin_settings' id='admin_redirect'>Change Category Order</a>
                        </div>");
            }
        ?>
    </div>
</div>
<div class="row" id="dbcontent">
    <div class="col">
        <?php
            if(isset($_GET['postid']))
                include_once 'Modules/post_content.php';
            else if(isset($_GET['category_id']))
                include_once 'Modules/posts.php';
            else
                include_once 'Modules/categories.php';
        ?>
    </div>
</div>
<?php
    include_once("./Modules/footer.php");
?>
