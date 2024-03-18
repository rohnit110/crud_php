<?php
include "Database/database.php";

// Check if product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $id = $_GET['product_id'];

    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE product_id = '$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("query failed");
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}

if (isset($_POST['update'])) {
    if (isset($_POST['id'])) {
        $idnew = $_POST['id'];
    }

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $filePath = $row['product_image'];
    if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
        $targetDir = "Config/";

        $uploadedFileName = basename($_FILES['images']['name']);
        $targetFilePath = $uploadedFileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $types = ['jpg', 'png', 'jpeg'];
        if (in_array($fileType, $types)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $targetFilePath)) {
                $filePath = $targetFilePath;
            } else {
                die("Error uploading file");
            }
        } else {
            die("Invalid file type. Only JPG, JPEG, PNG are allowed.");
        }
    }

    $query = "UPDATE products SET product_name = '$name', product_description = '$description', price = '$price', product_image = '$filePath' WHERE product_id = '$idnew'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("query failed");
    } else {
        header('location: dashboard.php');
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="row justify-content-center mt-5">
        <div class="col-4 text-center mt-5">
            <form action="update.php?product_id=<?php echo $id; ?>" method="post" id="add" class="add" enctype="multipart/form-data">
                <h2 class="h2 mb-3 ">Update Data</h2>
                <div class="form-group text-align-center mb-3">
                    <input type="text" class="form-control" name="id" id="product_id" placeholder="product id" value="<?php echo $row['product_id'] ?>">
                    <!-- <label for="id">Product_id</label> -->
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Product name" value="<?php echo $row['product_name'] ?>">
                    <!-- <label for="name">Product</label> -->
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" name="description" id="description" placeholder="Product Description" value="<?php echo $row['product_description'] ?>">
                    <!-- <label for="description">Description</label> -->
                </div>
                <div class="form-group mb-3">
                    <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $row['price'] ?>">
                    <!-- <label for="price">Price</label> -->
                </div>
                <div class="form-group mb-3">
                    <!-- <label for="images" class="form-label">Choose Images :</label> -->
                    <input type="file" class="form-control" name="images" id="images" value="<?php echo $row['product_image'] ?>" >
                </div>
                <input type="submit" class="btn rounded-pill btn-lg btn-success" value="Update" name="update">
                <button type="button" class="btn rounded-pill btn-success btn-lg" onclick="window.location.href='dashboard.php'">Dashboard</button>
            </form>
        </div>
</body>

</html>