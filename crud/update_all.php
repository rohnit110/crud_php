<?php
include "database/database.php";

// $new = [
//     ["QuantumTech Smartwatch", " ",],
//     ["TurboCharge Power Bank", " ",],
//     ["ZenithX Noise-Canceling Headphones", " ",],
//     ["EcoLux Bamboo Bed Sheets", " ",],
//     ["SolarFlare Portable Solar Charger", " ",],
//     ["VelocityPro Gaming Mouse", " ",],
//     ["AirFlow Sports Water Bottle", " ",],
//     ["NeoFit Resistance Bands Set", " ",],
//     ["NebulaGlow Galaxy Projector", " ",],
//     ["AeroSwift Running Shoes", " ",],
//     ["GourmetBlend Coffee Sampler", " ",],
//     ["HarmonyHome Smart Thermostat", " ",],
//     ["CelestialAura Crystal Necklace", " ",],
//     ["UltraVibe Massage Gun", " ",],
//     ["PinnaclePeak Hiking Backpack", " ",],
//     ["NovaVision VR Headset", " ",],
//     ["PixelPerfect 4K Monitor", " ",],
//     ["EcoBloom Indoor Plant Kit", " ",],
//     ["MysticMist Essential Oil Diffuser", " ",],
//     ["AquaSplash Waterproof Bluetooth Speaker", " ",],
// ];
// $productData = array(
//     array(1001, 'Smartphone X', 'High-performance smartphone with advanced features.', 699.99),
//     array(1002, 'Laptop Pro', 'Powerful laptop for professional use.', 1299.99),
//     array(1003, 'Wireless Earbuds', 'Premium wireless earbuds with noise cancellation.', 129.99),
//     array(1004, 'Fitness Tracker', 'Track your fitness activities and monitor health.', 49.99),
//     array(1005, 'LED Smart TV', 'Ultra HD smart TV with a vibrant display.', 899.99),
//     array(1006, 'Designer Sunglasses', 'Stylish sunglasses with UV protection.', 79.99),
//     array(1007, 'Coffee Maker', 'Automatic coffee maker for the perfect brew.', 59.99),
//     array(1008, 'Gaming Console', 'Next-gen gaming console for immersive gaming experiences.', 499.99),
//     array(1009, 'Portable Bluetooth Speaker', 'Compact and powerful Bluetooth speaker.', 39.99),
//     array(1010, 'Digital Camera', 'Capture high-quality photos with this advanced digital camera.', 799.99),
//     array(1011, 'Running Shoes', 'Comfortable and durable running shoes for athletes.', 89.99),
//     array(1012, 'Backpack', 'Spacious and stylish backpack for daily use.', 49.99),
//     array(1013, 'Smart Thermostat', 'Energy-efficient smart thermostat for home automation.', 129.99),
//     array(1014, 'Wireless Mouse', 'Ergonomic wireless mouse for precise control.', 29.99),
//     array(1015, 'Graphic Design Software', 'Professional software for graphic designers.', 199.99),
//     array(1016, 'Cookware Set', 'High-quality cookware set for your kitchen.', 129.99),
//     array(1017, 'Yoga Mat', 'Non-slip yoga mat for your fitness routine.', 19.99),
//     array(1018, 'Robot Vacuum Cleaner', 'Smart robot vacuum for automated cleaning.', 199.99),
//     array(1019, 'Action Camera', 'Capture your adventures with this compact action camera.', 149.99),
//     array(1020, 'Wireless Charging Pad', 'Convenient wireless charging pad for your devices.', 34.99)
// );


// $sql = "UPDATE products SET product_id = ?, product_name = ?, product_description = ?, price = ? WHERE id = ?";
// $st = $conn->prepare($sql);

// $conn->begin_transaction();

// $i = 1;
// foreach ($productData as $row) {
//     $st->bind_param("issii", $row[0], $row[1], $row[2], $row[3], $i);
//     $st->execute();
//     $i++;
// }
// $conn->commit();

?>

<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body> -->

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'myproduct';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $recordIds = $_POST['record_ids'];

    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        $fileName = $_FILES['images']['name'][$key];
        $filePath = $fileName;

        move_uploaded_file($tmpName, $filePath);

        $recordId = $recordIds[$key];
        $sql = "UPDATE products SET product_image = '$filePath' WHERE id = $recordId";

        if ($conn->query($sql) !== TRUE) {
            echo "Error updating record: " . $conn->error;
        } else {
            echo "Added";
        }
    }

    $conn->close();
}

?>

<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">

                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="record_ids" class="form-label">Select Records :</label>
                    
                        <input type="num" name="record_ids[]" id="record_ids" multiple>
                    </div>
                    <br>
                    <div>
                        <label for="images" class="form-label">Choose Images :</label>
                        <input type="file" class="form-control" name="images[]" id="images" multiple>
                    </div>
                    <br>
                    <input class="btn btn-primary" type="submit" value="Upload Images" name="submit">
                </form>

            </div>
        </div>

    </div>

</body>


</html>