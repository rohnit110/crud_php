$("#add").validate({
    rules:{
        id:{
         required: true,
         minlength: 3
     },
     name:{
         required: true,
         minlength: 4
     },
     description:{
         required: true,
         minlength: 15
     },
     price:{
         required: true,
         minlength:2
     },
     product_image: {
         required: true, 
         inputimage:{
         extension: "png|jpeg|gif", 
         filesize: 10000000
        }
         }
    },
    messages:{
        id:{
         required: "Enter product id",
         minlength: "Enter valid product id"
     },
     name:{
         required:  "Enter product name",
         minlength: "Enter valid product name"
     },
     description:{
         required:  "Enter product description",
         minlength: "Enter your product description in detail"
     },
     price:{
         required:  "Enter price",
         minlength:"Enter valid price"
     },
     product_image:{
        required:  "Upload valid image",
        inputimage: "File must be JPG, GIF or PNG, less than 1MB"
    }
    },
 })

 