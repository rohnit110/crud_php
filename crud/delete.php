<?php
include 'Database/database.php';

$name1 = $_GET['name'];
$sql = "DELETE FROM products WHERE product_name = '$name1'";
$data = mysqli_query($conn, $sql);
if($data){
    header("Location: dashboard.php");
}