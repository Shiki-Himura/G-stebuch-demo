<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col">
        <?php
            $user_post = "<label>Hey ".$_SESSION['valid_user']."! Wie wärs mit einem Post?</label>
                            <div class='row'>
                                <label>Titel: <input  id='post-title'></input></label>
                            </div>
                            <div class='row'>
                                <label>Beschreibung:</label>
                                <textarea id='post-description' type='text' cols='80' rows='4'></textarea>
                            </div>
                            <div class='row'>
                                <label>Beitrag verfassen:</label>
                                <textarea id='post-text' type='text' cols='172' rows='10'></textarea>
                            </div>
                            <div>
                                <button id='post_submit' class='btn btn-secondary'>Absenden</button>
                            </div>";
            if(isset($_SESSION['valid_user']))
                echo($user_post);
            else
            {
                header("Location: login.php");
                exit();
            }
        ?>
    </div>
</div>
<div class="row" id="dbcontent">
    
</div>
<?php
    include_once("./Modules/footer.php");
?>