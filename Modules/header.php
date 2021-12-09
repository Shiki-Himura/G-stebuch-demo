<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid fs-5">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand fs-3" href="index.php">Gästebuch</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                </ul>
            <ul class="navbar-nav mb-2 mb-lg-0" id="accessbtns">
                <?php
                if(!isset($_SESSION['valid_user']))
                    $_SESSION['valid_user'] = null;
                $nouser = "
                            <li class='nav-item'>
                                <a class='nav-link text-light' href='login.php'>Login</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' href='register.php'>Register</a>
                            </li>";
                $loggedin = "
                            <li class='nav-item'>
                                <div class='mt-2'>Willkommen
                                    <a id='user-profile' href='#'>".$_SESSION['valid_user']."!</a>
                                </div>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' id='logout_user' href='javascript:void(0)'>Logout</a>
                            </li>";
                $admin =   "<li class='nav-item'>
                                <div class='mt-2'>Willkommen
                                    <a id='user-profile' href='#'>".$_SESSION['valid_user']."!</a>
                                </div>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' id='logout_user' href='javascript:void(0)'>Logout</a>
                            </li>
                            <li class='nav-item'>
                                <a class='nav-link' id='adminsettings' href='administration.php?admin=update'>Settings</a>
                            </li>";
                if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == 'Admin')
                    echo $admin;
                else if(isset($_SESSION['valid_user']))
                    echo($loggedin);
                else
                    echo($nouser);
                ?>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
            </form>
        </div>
        </div>
    </nav>
    <div class="container">