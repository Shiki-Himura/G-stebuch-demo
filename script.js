$(function(){
    var name = $("#name");
    var text = $("#textarea");

    
    var error = $("#error_message");
    let user_available = false;
    let user_exists = false;
    
    $("#register").on("click", function(){
        let reg_user = $("#reg_un");
        let reg_password = $("#reg_pw");
        let reg_repeat = $("#reg_repeat_pw");

        if(reg_user.val()=="" || reg_password.val()=="" || reg_repeat.val()=="")
        {
            error.html("Please enter missing Information!");
            return;
        }
        
        if(reg_password.val() != reg_repeat.val())
        {
            error.html("Passwords don´t match!");
            return;
        }
        

        var reg_request = new XMLHttpRequest();
        reg_request.onload = function() {
            user_available = this.responseText;
            if(user_available == false)
            {
                error.html("User already exists!");
                return;
            }
        };
        reg_request.open("POST", "register_handler.php", false);
        reg_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        reg_request.send("check=check&un="+reg_user.val());


        var register = new XMLHttpRequest();
        register.onload = function() {
            if(user_available == true)
            {
                window.location.href = "login.php";
            }
        };
        register.open("POST", "register_handler.php");
        register.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        register.send("check=register&un="+reg_user.val()+"&pw="+reg_password.val());
    });

    
    $("#index_login").on("click", function() {
        let log_user = $("#log_un");
        let log_password = $("#log_pw");

        if(log_user.val() == "" || log_password.val() == "")
        {
            error.html("Please enter missing Information!");
            return;
        }

        // TODO: implement login
        let login = new XMLHttpRequest();
        login.onload = function() {
            user_exists = this.responseText;
            if(user_exists == false)
            {
                error.html("User doesn´t exist!");
                return;
            }
            login.open("POST", "login_handler.php", false);
            login.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            login.send("login=user&un="+log_user.val());
        };
    });

    
    $("#index_submit").on('click', function(){
        // TODO: refactor click event handler to $.ajax syntax
        const request = new XMLHttpRequest();
        request.onload = function(){
            $('#dbcontent').innerHTML = this.responseText;
        };
        request.open('POST', 'request.php');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("name="+name.val()+"&text="+text.val());
    });

});
