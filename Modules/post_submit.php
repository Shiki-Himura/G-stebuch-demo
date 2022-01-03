<?php
    $user_post = "  <div class='d-flex flex-column w-50 mb-2' style='margin-left:auto'>
                        <textarea id='post-description' class='text-light bg-dark' type='text' cols='50' rows='5'></textarea>
                    </div>
                    <div class='d-flex flex-column' style='margin-left:auto'>
                        <button id='index_submit' class='btn btn-light'>Comment</button>
                    </div>";
    if(isset($_SESSION['valid_user']))
        echo($user_post);
?>
