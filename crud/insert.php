<?php
include 'Database/database.php';

$productData = array(
    array(1001, 'Smartphone X', 'High-performance smartphone with advanced features.', 699.99),
    array(1002, 'Laptop Pro', 'Powerful laptop for professional use.', 1299.99),
    array(1003, 'Wireless Earbuds', 'Premium wireless earbuds with noise cancellation.', 129.99),
    array(1004, 'Fitness Tracker', 'Track your fitness activities and monitor health.', 49.99),
    array(1005, 'LED Smart TV', 'Ultra HD smart TV with a vibrant display.', 899.99),
    array(1006, 'Designer Sunglasses', 'Stylish sunglasses with UV protection.', 79.99),
    array(1007, 'Coffee Maker', 'Automatic coffee maker for the perfect brew.', 59.99),
    array(1008, 'Gaming Console', 'Next-gen gaming console for immersive gaming experiences.', 499.99),
    array(1009, 'Portable Bluetooth Speaker', 'Compact and powerful Bluetooth speaker.', 39.99),
    array(1010, 'Digital Camera', 'Capture high-quality photos with this advanced digital camera.', 799.99),
    array(1011, 'Running Shoes', 'Comfortable and durable running shoes for athletes.', 89.99),
    array(1012, 'Backpack', 'Spacious and stylish backpack for daily use.', 49.99),
    array(1013, 'Smart Thermostat', 'Energy-efficient smart thermostat for home automation.', 129.99),
    array(1014, 'Wireless Mouse', 'Ergonomic wireless mouse for precise control.', 29.99),
    array(1015, 'Graphic Design Software', 'Professional software for graphic designers.', 199.99),
    array(1016, 'Cookware Set', 'High-quality cookware set for your kitchen.', 129.99),
    array(1017, 'Yoga Mat', 'Non-slip yoga mat for your fitness routine.', 19.99),
    array(1018, 'Robot Vacuum Cleaner', 'Smart robot vacuum for automated cleaning.', 199.99),
    array(1019, 'Action Camera', 'Capture your adventures with this compact action camera.', 149.99),
    array(1020, 'Wireless Charging Pad', 'Convenient wireless charging pad for your devices.', 34.99)
);

$types = array(
    ['Electronics'],
    ['Clothing'],
    ['Home and Kitchen'],
    ['Books'],
    ['Beauty and Personal Care'],
    ['Toys and Games'],
    ['Sports and Outdoors'],
    ['Automotive'],
    ['Health and Household'],
    ['Tools and Home Improvement'],
    ['Jewelry'],
    ['Furniture'],
    ['Baby Products'],
    ['Office Supplies'],
    ['Pet Supplies'],
    ['Grocery'],
    ['Fitness and Exercise'],
    ['Outdoor Gear'],
    ['Appliances'],
    ['Musical Instruments']
);
//Product table
foreach ($productData as $dat) {
    $product_id = $dat[0];
    $product_name = $dat[1];
    $description = $dat[2];
    $price = $dat[3];

    $sql = "INSERT INTO products (product_id, product_name,product_description,price) VALUES (' $product_id','$product_name','$description','$price')";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Error inserting data: " . $conn->error;
        die();
    }
}

echo "Data inserted successfully.";

//Category table
// foreach ($types as $category) {
//     $categoryName = $category[0];
//     $sql2 = "INSERT INTO category (category_name) VALUES ('$categoryName')";
//     $total = $conn->query($sql2);

//     if (!$total) {
//         echo "Error inserting data: " . $conn->error;
//         die();
//     }
// }
// echo "Data inserted successfully.";
// $conn->commit();
