<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col-8 fs-6">
        <?php
            $user_post = "<label class='fs-3'>Hey ".$_SESSION['valid_user']."! Wie wärs mit einem neuen Post?</label>
                            <div class='row'>
                                <label>Titel:</label>
                                <textarea class='text-white bg-dark' id='post-title' type='text' rows='2' cols='10' autofocus></textarea>
                            </div>
                            <div class='row'>
                                <label>Beschreibung:</label>
                                <textarea class='text-white bg-dark' id='post-description' type='text' rows='5'></textarea>
                            </div>
                            <div class='row'>
                                <label>Beitrag verfassen:</label>
                                <textarea class='text-white bg-dark' id='post-text' type='text' cols='172' rows='10'></textarea>
                            </div>
                            <div>
                                <button id='post_submit' class='btn btn-light'>Absenden</button>
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