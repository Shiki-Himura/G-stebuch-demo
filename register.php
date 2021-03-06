<?php
    include_once("./Modules/header.php");
?>
<div class="row justify-content-center">
    <div class="col-4 d-flex flex-column fs-5 mt-5">
        <label id="reginfo" class="fst-italic text-danger fs-6">*Please enter the required Information</label>
        <div id="register_form_name">
            <label>*Name:
                <input class="float-end" id="reg_un" placeholder="Username" autofocus/>
            </label>
        </div>
        <div id="register_form_pw">
            <label>*Password:
                <input class="float-end" id="reg_pw" type="password" placeholder="Password"/>
            </label>
        </div>
        <div id="register_form_repeat">
            <label>*Repeat Password:
                <input class="float-end" id="reg_repeat_pw" type="password" placeholder="Repeat Password"/>
            </label>
        </div>
        <div class="fs-6 text-danger" id="error_message"></div>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-3 d-flex flex-column">
        <button id="register" class="btn btn-outline-light">Register</button>
    </div>
</div>
<?php
    include_once("./Modules/footer.php");
?>