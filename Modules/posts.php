<div id="newpostbtn" class="fs-5"><a href=<?php echo "newpost.php?category_id=".$_REQUEST['category_id'] ?>>New Post</a></div>
<table id="post-table" class="table table-striped table-dark">
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