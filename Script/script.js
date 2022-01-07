$(function(){

    $(".profile_link").on({
        mouseenter: function(link) {
            $(link.target).addClass("profile_link_hover").css("cursor", "pointer");
        },
        mouseleave: function(link) {
            $(link.target).removeClass("profile_link_hover");
        }
    });

    tinymce.init({
        selector: 'textarea#post-text',
        entity_encoding: 'raw',
        plugins: 'quickbars table image link lists media help',
        skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
        height: '400',
        menubar: true,
        resize: true,
        toolbar_mode: 'floating',
        toolbar: 'undo redo | formatselect | bold italic | alignleft aligncentre alignright alignjustify | bullist numlist',
    });


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    var error = $("#error_message");
    var logerror = $("#login_error");

    $("#index_login").on("mouseenter", function() {
        $(this).removeClass("btn-outline-light").addClass("btn-light");
    }).on("mouseleave", function() {
        $(this).removeClass("btn-light").addClass("btn-outline-light");
    });
    $("#register").on("mouseenter", function() {
        $(this).removeClass("btn-outline-light").addClass("btn-light");
    }).on("mouseleave", function() {
        $(this).removeClass("btn-light").addClass("btn-outline-light");
    });
    
    function RegisterHandler()
    {
        let user_available = false;
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
            error.html("Passwords don`t match!");
            return;
        }
        
        // validate user registration
        $.post("Logic/AccountManager.php",
                { 
                    key:"validate", 
                    un:reg_user.val() 
                }, function(data){
                    user_available = data;
                    if(user_available == false)
                    {
                        error.html("User already exists!");
                        return;
                    }
                    else if(user_available == true)
                    {
                        $.post("Logic/AccountManager.php",
                            {
                                key: "execregister",
                                un: reg_user.val(),
                                pw: reg_password.val()
                            });
                        window.location.href = "./login.php";
                    }
                });
    }

    // validate and register the user
    $("#register").on("click", function(){
        RegisterHandler();
    });

    $("#reg_repeat_pw,#reg_pw").on("keydown", function(e) {
        if(e.which == 13)
        {
            RegisterHandler();
            return false;
        }
    });
    
    function LoginHandler()
    {
        let user_exists = false;
        let log_user = $("#log_un");
        let log_password = $("#log_pw");
        
        if(log_user.val()=="" || log_password.val()=="")
        {
            logerror.html("Please enter missing Information!");
            return;
        }
        
        // login user
        $.post("Logic/AccountManager.php",
                {
                    key: "execlogin",
                    login: "user",
                    un: log_user.val(),
                    pw: log_password.val()
                }, function(data){
                    user_exists = data;
                    if(user_exists == false)
                    {
                        logerror.html("Please check your Username/Password");
                        return;
                    }
                    else if(user_exists == true)
                        window.location.href = "index.php";
                });
    }

    // validate and login user
    $("#index_login").on("click", function() {
        LoginHandler();
    });

    $("#log_pw,#log_un").on("keydown", function(e) {
        if (e.which == 13) {
            LoginHandler();
            return false;
        }
    });

    // logout user
    $("#logout_user_nav,#logout_user_profile").on("click", function() {
        $.post("Logic/AccountManager.php", 
                {
                    key: "execlogout",
                    success: function(){
                        window.location.href = "index.php";
                    }
                });
    });

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $("#index_submit").on('click', function(){
        // TODO: refactor click event handler to $.ajax syntax
        let post_comment = tinymce.get('post-description').getContent();
        if(post_comment == "")
        {
            alert("Please enter missing Information!");
            return;
        }

        let request = new XMLHttpRequest();
        request.onload = function(){
            $('#post-comment').html(this.responseText);
            tinymce.get('post-description').setContent('');
        };
        let get_urlval = window.location.href.split("?")[1];
        request.open('POST', './Logic/ContentManager.php?' + get_urlval);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("key=setcontent&posttext="+post_comment);
    });

    $("#post_submit").on("click", function(){
        let post_title = $("#post-title");
        let post_description = $("#post-description");
        let post_text = tinymce.get("post-text").getContent();

        if(post_title.val() == "" || post_description.val() == "" || post_text == "")
        {
            alert("Please enter missing Information!");
            return;
        }

        let get_urlval = window.location.href.split("?")[1];
        $.post("Logic/ContentManager.php?"+get_urlval,
                {
                    key: "setpost",
                    title: post_title.val(),
                    description: post_description.val(),
                    posttext: post_text,
                    success: function(){
                        window.location.href = "index.php";
                    }
                });
    });

    var dir = "desc";
    $("th").on("click", function(){
        let table = $('#post-table');
        let tbody = $('#posts');
        
        tbody.find('tr').sort(function(a, b){
            if(dir == "asc")
            {
                dir = "desc";
                return $('td:first', a).text().localeCompare($('td:first', b).text());
            }
            else
            {
                dir = "asc";
                return $('td:first', b).text().localeCompare($('td:first', a).text());
            }
        }).appendTo(tbody);
    });
});
