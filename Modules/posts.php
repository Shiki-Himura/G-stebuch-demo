    <div class="row">
        <div class="col">
            <div id="newpostbtn" class="fs-6 fw-bold btn btn-dark col-1"><a href=<?php echo "newpost.php?category_id=".$_REQUEST['category_id'] ?>>New Post</a></div>
        </div>
    </div>

<div class="row">
    <div class="col">
        <table id="post-table" class="table table-striped table-dark">
            <thead>
                <tr>
                    <th id="th-topic">Topic</th>
                    <th id="th-author">Author</th>
                    <th id="th-date">Creation-Date</th>
                </tr>
            </thead>
            <tbody id="posts">
                <?php include_once "./Logic/ContentManager.php"?>
            </tbody>
        </table>
    </div>
</div>