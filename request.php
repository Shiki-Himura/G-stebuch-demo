<?php
    $connection = new mysqli('localhost', 'root', '', 'gästebuch');
    if(mysqli_connect_error())
    {
        echo "Database connection failed";
        exit;
    }

    if(isset($_REQUEST['name']) && isset($_REQUEST['text']))
    {
        $dbWrite = "INSERT INTO `content` (`Name`,`Text`) VALUES ('".$_REQUEST['name']."','".$_REQUEST['text']."')";
        $result = $connection->query($dbWrite);
    }
    
    $html = "";
    $dbRead = "SELECT * FROM `content` ORDER BY ID DESC";
    $result = $connection->query($dbRead);

    while($row = $result->fetch_object())
    {
        $previewBody = "<div class='card'>
                            <div class='card-header'>".$row->Name."
                            <div class='float-end'>".$row->Date."</div>
                            </div>
                            <div class='card-body'>
                            <p class='card-text'>".$row->Text."</p>
                            </div>
                        </div>";
        $html .= $previewBody;
    }
    echo($html);
?>