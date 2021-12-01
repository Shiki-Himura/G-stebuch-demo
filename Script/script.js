$(function(){
    $('#current-user').css('textShadow','2px 2px 4px lightgrey');
    $(".navbar").css(
        {
            background:'linear-gradient(65deg, #0000ff 0%, #000000 25%, #000022 50%, #000055 75%, #000099 100%',
            color:'rgb(255, 255, 255)'
        });

    
    var error = $("#error_message");
    var logerror = $("#login_error");
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
        

        let reg_request = new XMLHttpRequest();
        reg_request.onload = function() {
            user_available = this.responseText;
            if(user_available == false)
            {
                error.html("User already exists!");
                return;
            }
        };
        reg_request.open("POST", "./Logic/AccountManager.php", false);
        reg_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        reg_request.send("key=validate&un="+reg_user.val());


        let register = new XMLHttpRequest();
        register.onload = function() {
            if(user_available == true)
                window.location.href = "./login.php";
        };
        register.open("POST", "./Logic/AccountManager.php");
        register.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        register.send("key=execregister&un="+reg_user.val()+"&pw="+reg_password.val());
    });

    
    $("#index_login").on("click", function() {
        let log_user = $("#log_un");
        let log_password = $("#log_pw");
        
        if(log_user.val()=="" || log_password.val()=="")
        {
            logerror.html("Please enter missing Information!");
            return;
        }
        
        let login = new XMLHttpRequest();
        login.onload = function(){
            user_exists = this.responseText;
            if(user_exists == false)
            {
                logerror.html("Please check your Username/Password");
                return;
            }

            if(user_exists == true)
                window.location.href = "./index.php";
        };
        login.open("POST", "./Logic/AccountManager.php");
        login.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        login.send("key=execlogin&login=user&un="+log_user.val()+"&pw="+log_password.val());
    });

    $("#logout_user").on("click", function() {
        let logout = new XMLHttpRequest();
        logout.onload = function(){
            window.location.href = "./index.php";
        };
        logout.open("POST", "./Logic/AccountManager.php");
        logout.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        logout.send("key=execlogout");
    });


    $("#index_submit").on('click', function(){
        // TODO: refactor click event handler to $.ajax syntax
        let request = new XMLHttpRequest();
        request.onload = function(){
            $('#dbcontent').html(this.responseText);
        };
        request.open('POST', './Logic/ContentManager.php');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("key=setcontent&text="+text.val());
    });

    $("#post_submit").on("click", function(){
        let post_title = $("#post-title");
        let post_description = $("#post-description");
        let post_text = $("#post-text");

        let request = new XMLHttpRequest();
        request.onload = function(){
            window.location.href = "index.php";
        };
        request.open('POST', './Logic/ContentManager.php');
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("key=setpost&title="+post_title.val()+"&description="+post_description.val()+"&posttext="+post_text.val());
    });
    
});
