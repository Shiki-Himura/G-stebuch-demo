<?php
    $user_post = "  <div class='d-flex flex-column w-50'>
                        <textarea id='post-description' class='text-white bg-dark' placeholder='Here you can enter a comment!' type='text' cols='50' rows='5'></textarea>
                        <div class='d-flex'>
                            <button id='index_submit' class='btn btn-light'>Submit</button>
                        </div>
                    </div>";
    if(isset($_SESSION['valid_user']))
        echo($user_post);
?>
