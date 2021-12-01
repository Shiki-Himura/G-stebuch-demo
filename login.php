<?php
    include_once("./Modules/header.php");
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<div class="row justify-content-center">
    <div class="col-4 d-flex flex-column">
        <label>Name:
            <input class="float-end" id="log_un" type="text" placeholder="Username">
        </label>
        <label>Password:
            <input class="float-end" id="log_pw" type="password" placeholder="Password">
        </label>
        <div class="fs-6 text-danger" id="login_error"></div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-3 d-flex flex-column">
        <button id="index_login" class="btn btn-success">Login</button>
    </div>
</div>
<?php
    include_once("./Modules/footer.php");
?>