<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>Gästebuch</title>
</head>
<body>
    <?php
        require_once 'nav.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                    $user_entry = "<label>Name:
                                        <input id='name'>
                                    </label>
                                    <div>
                                        <textarea id='textarea' type='text' cols='50' rows='10'></textarea>
                                    </div>
                                    <div>
                                        <button id='index_submit' class='btn btn-secondary'>Absenden</button>
                                    </div>";
                    if(isset($_SESSION['valid_user']))
                    {
                        echo($user_entry);
                    }
                ?>
            </div>
        </div>
        <div class="row" id="dbcontent">
            <?php
                require_once 'request.php';
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="script.js"></script>
</body>
</html>