<?php
    include_once("./Modules/header.php");
?>
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
<?php
    include_once("./Modules/footer.php");
?>