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
        $(this).removeClass("btn-outline-light").addClass("btn-outline-dark");
    }).on("mouseleave", function() {
        $(this).removeClass("btn-outline-dark").addClass("btn-outline-light");
    });
    $("#register").on("mouseenter", function() {
        $(this).removeClass("btn-outline-light").addClass("btn-outline-dark");
    }).on("mouseleave", function() {
        $(this).removeClass("btn-outline-dark").addClass("btn-outline-light");
    });
    
    // validate and register the user
    $("#register").on("click", function(){
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
    });
    
    // validate and login user
    $("#index_login").on("click", function() {
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
    });

    // logout user
    $("#logout_user").on("click", function() {
        // $.post("Logic/AccountManager.php", 
        //         {
        //             key: "execlogout"
        //         }, function(data){
        //             window.location.href = "Logic/AccountManager.php";
        //         });

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

    $("th").on("click", function() {
        let rows, switching, shouldSwitch, switchcount = 0;
        let table = $('#post-table').html();
        let dir = "asc";
        switching = true;

        while (switching)
        {
          switching = false;
          for (let i = 1; i < table.length; i++)
          {
            shouldSwitch = false;
            let x = rows[i].getElementsByTagName("td")[n];
            let y = rows[i + 1].getElementsByTagName("td")[n];
            if (dir == "asc")
            {
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase())
              {
                shouldSwitch = true;
                break;
              }
            }
            else if (dir == "desc")
            {
              if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase())
              {
                shouldSwitch = true;
                break;
              }
            }
          }
          if (shouldSwitch) 
          {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;
          } 
          else
          {
            if (switchcount == 0 && dir == "asc")
            {
              dir = "desc";
              switching = true;
            }
          }
        }
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
