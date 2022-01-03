$(function(){
    tinymce.init({
        selector: 'textarea#post-title',
        auto_focus: 'post-title',
        entity_encoding: 'raw',
        skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
        height: '160',
        menubar: false,
        toolbar_mode: 'floating',
        toolbar: "formatgroup",
        toolbar_groups: {
            formatgroup: {
                icon: 'format',
                tooltip: 'Formatting',
                items: 'bold italic | formatselect | removeformat'
            },
        },
    });

    tinymce.init({
        selector: 'textarea#post-description',
        entity_encoding: 'raw',
        skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
        height: '200',
        menubar: false,
        resize: true,
        toolbar_mode: 'floating',
        toolbar: "formatgroup",
        toolbar_groups: {
            formatgroup: {
                icon: 'format',
                tooltip: 'Formatting',
                items: 'bold italic underline | formatselect | removeformat'
            },
        },
      });  
      tinymce.init({
        selector: 'textarea#post-text',
        entity_encoding: 'raw',
        skin: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
        content_css: (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
        height: '400',
        menubar: false,
        resize: true,
        toolbar_mode: 'floating',
        toolbar: "formatgroup",
        toolbar_groups: {
          formatgroup: {
              icon: 'format',
              tooltip: 'Formatting',
              items: 'bold italic underline strikethrough | forecolor backcolor | formatselect | removeformat'
          },
        },
      });

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
    $("#logout_user").on("click", function() {
        $.post("Logic/AccountManager.php", 
                {
                    key: "execlogout",
                    success: function(){
                        window.location.href = "./index.php";
                    }
                });
    });


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
        let post_title = tinymce.get("post-title").getContent();
        let post_description = tinymce.get("post-description").getContent();
        let post_text = tinymce.get("post-text").getContent();

        if(post_title == "" || post_description == "" || post_text == "")
        {
            alert("Please enter missing Information!");
            return;
        }

        let get_urlval = window.location.href.split("?")[1];
        $.post("Logic/ContentManager.php?"+get_urlval,
                {
                    key: "setpost",
                    title: post_title,
                    description: post_description,
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
                return $('td:first', a).html().localeCompare($('td:first', b).html());
            }
            else
            {
                dir = "asc";
                return $('td:first', b).html().localeCompare($('td:first', a).html());
            }
        }).appendTo(tbody);
    });

    $("#update_category_order").on("click", function(){
        // TODO: add stuff to admin update function
        console.log("hi");
        let categoryName = $('#categories').val();
        let orderValue = $('#order').val();

        // $.post("Logic/ContentManager.php",
        //         {
        //             admin: "update",
        //             options: "changeOrder"
        //         }).done(function() {
        //             console.log('Done Updating!');
        //         });
    });
});
