<?php
// //Rohnit  E-commerce Domain:
// Question: Develop an e-commerce platform where users can browse products, and perform search and sort operations.

// Create two tables: products and categories.
// Implement pagination to display products.
// Allow users to search for products by name or price.
// Enable sorting by product attributes for price,

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'myproduct';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// "CREATE DATABASE myproduct";


$sql = "CREATE TABLE products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    product_name VARCHAR (40) NOT NULL,
    product_description VARCHAR (100) NOT NULL,
    price VARCHAR (20) NOT NULL,
    product_id INT 
    product_image (50) NOT NULL
 )";


// if ($conn->query($sql) === TRUE) {
//     echo "Table created successfully";
// } else {
//     echo "Error creating table: " . $conn->error;
// }
// CREATE DATABASE myproduct;
// USE myproduct;

// CREATE TABLE products (
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
//     product_name VARCHAR (40) NOT NULL,
//     product_description VARCHAR (100) NOT NULL,
//     price VARCHAR (20) NOT NULL,
//     product_id INT 
//     product_image (50) NOT NULL);

// CREATE TABLE user_(
//         id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
//         username VARCHAR (50) NOT NULL,
//         emailId VARCHAR (100) NOT NULL,
//         mo_num VARCHAR (100) NOT NULL,
//         pswd (255) NOT NULL
//     );
