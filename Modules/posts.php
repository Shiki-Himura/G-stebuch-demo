    <div class="col">
        <div id="newpostbtn" class="fs-6 fw-bold btn btn-dark"><a href=<?php echo "newpost.php?category_id=".$_REQUEST['category_id'] ?>>New Post</a></div>
    </div>

<table id="post-table" class="table table-striped table-secondary">
    <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Creation-Date</th>
        </tr>
    </thead>
    <tbody id="posts">
        <?php include_once "./Logic/ContentManager.php"?>
    </tbody>
</table>