<?php
include "Database/database.php";

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if ($_FILES["product_image"]["error"] === 4) {
        echo "<script>alert('Image doesn\'t exist');</script>";
    }

    $filename = $_FILES['product_image']['name'];
    $filesize = $_FILES['product_image']['size'];
    $tmpname = $_FILES['product_image']['tmp_name'];
    // $folder = "/Config";

    $Extension = ["jpg", "jpeg", "png"];
    $image = explode('.', $filename);
    $image = strtolower(end($image));


    $newimagename = uniqid();
    $newimagename .= '.' . $image;

    move_uploaded_file($tmpname, 'Config/' . $newimagename);
    $query = "INSERT INTO products(product_id, product_name, product_description, price, product_image) VALUES('$id', '$name', '$description', '$price', '$newimagename')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Successfully added');</script>";
    } else {
        echo "add Data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <style>
        body {
            background-image: url("add-back.jpeg");
        }

        a {
            text-decoration: none;
        }

        .error {
            color: red;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-4 text-center mt-5">
                <form action="" method="post" id="add" class="add" enctype="multipart/form-data">
                    <h2 class="h2 mb-3 ">Add Data</h2>
                    <div class="form-group text-align-center mb-3">
                        <input type="text" class="form-control" name="id" id="id" placeholder="product id">
                        <!-- <label for="id">Product_id</label> -->
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Product name">
                        <!-- <label for="name">Product</label> -->
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Product Description">
                        <!-- <label for="description">Description</label> -->
                    </div>
                    <div class="form-group mb-3">
                        <input type="number" class="form-control" name="price" id="price" placeholder="Price">
                        <!-- <label for="price">Price</label> -->
                    </div>
                    <div class="form-group mb-3">
                        <input type="file" class="form-control" name="product_image" id="product_image">
                        <!-- <label for="product_image">Image</label> -->
                    </div>
                    <input type="submit" class="btn rounded-pill btn-lg btn-success" value="Add" name="submit">
                    <button type="button" class="btn rounded-pill btn-success btn-lg" onclick="window.location.href='dashboard.php'">Dashboard</button>
                </form>
            </div>
            <script src="valid_add.js"></script>
        </div>
</body>

</html>