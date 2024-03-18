<?php
include 'Database/database.php';

if (isset($_POST["user_name"])) {

    $username = mysqli_real_escape_string($conn, $_POST["user_name"]);
    $sql = "SELECT * FROM user_ WHERE username = '" . $username . "'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}
