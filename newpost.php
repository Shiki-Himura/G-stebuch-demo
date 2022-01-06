<?php
    include_once("./Modules/header.php");
?>
<div class="row">
    <div class="col-8 fs-6 mt-5">
        <?php
            $user_post = "  <div class='row justify-content-start'>
                                <div class='col-2'>
                                    <label>Title:</label>
                                </div>
                            </div>
                            <div class='row justify-content-start'>
                                <div class='col mb-4 mt-1'>
                                    <textarea class='text-white bg-dark' id='post-title' type='text' rows='1' cols='50' autofocus></textarea>
                                </div>
                            </div>

                            <div class='row justify-content-start'>
                                <div class='col-2'>
                                    <label>Description:</label>
                                </div>
                            </div>
                            <div class='row justify-content-start'>
                                <div class='col mb-4 mt-1'>
                                    <textarea class='text-white bg-dark' id='post-description' type='text' rows='4' cols='50'></textarea>
                                </div>
                            </div>

                            <div class='row justify-content-start'>
                                <div class='col-3'>
                                    <label>Text:</label>
                                </div>
                            </div>
                            <div class='row justify-content-start'>
                                <div class='col mb-4 mt-1'>
                                    <textarea class='text-white bg-dark' id='post-text' type='text' cols='172' rows='10'></textarea>
                                </div>
                            </div>

                            <div class='row justify-content-start mt-3'>
                                <div class='col'>
                                    <button id='post_submit' class='btn btn-light'>Absenden</button>
                                </div>
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