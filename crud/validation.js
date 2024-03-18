  $("#loginform").validate({
        rules: {
            username:{
                required: true,
                minlength:3,
            },
            pswd:{
                required: true,
                minlength:5
            }
        },
        messages:{
            username: {
                required: "Please enter username",
                minlength: "Please enter atleast 3 character"
            },
            pswd:{
                required: "Please enter password",
                minlength: "Please enter atleast 5 character"
            }
        }
    });