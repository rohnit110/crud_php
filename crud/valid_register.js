$("#register").validate({
   rules:{
    username:{
        required: true,
        minlength: 3
    },
    email:{
        required: true,
        email: true
    },
    mo_num:{
        required: true,
        maxlength : 10,
        minlength: 10
    },
    pswd:{
        required: true,
        minlength:5
    }
  },

   messages:{ 
    username:{
        required: "Enter your username | ",
        minlength: "Enter atleast 3 keywords | "
    },
    email:{
        required: "Enter your email | ",
        email: "Enter valid email | "
    },
    mo_num:{
        required: "Enter your mobile number",
        maxlength : "Enter your valid mobile number(less then 10 number)",
        minlength: "Enter your valid mobile number(greater then 10 number)"
    },
    pswd:{
        required: "Enter your password",
        minlength: "Enter atleast 5 character"
    }
  }
})