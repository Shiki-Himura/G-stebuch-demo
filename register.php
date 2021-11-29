<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./style.css" rel="stylesheet">
    <title>Register</title>
</head>
<body>
    <?php
        require_once './Modules/nav.php';
    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 d-flex flex-column">
                <label class="fs-6 fst-italic text-muted">Please enter the required Information*</label>
                <label>*Name:
                    <input class="float-end" id="reg_un" placeholder="Username"/>
                </label>
                <label>*Password:
                    <input class="float-end" id="reg_pw" type="password" placeholder="Password"/>
                </label>
                <label>*Repeat Password:
                    <input class="float-end" id="reg_repeat_pw" type="password" placeholder="Repeat Password"/>
                </label>
                <div class="fs-6 text-danger" id="error_message"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3 d-flex flex-column">
                <button id="register" class="btn btn-success">Register</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./Script/script.js"></script>
</body>
</html>