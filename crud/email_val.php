<?php
include 'Database/database.php';

if (isset($_POST["emailid"])) {

    $email = mysqli_real_escape_string($conn, $_POST["emailid"]);
    $sql = "SELECT * FROM user_ WHERE emailId ='" . $email . "'";
    $result = mysqli_query($conn, $sql);
    echo mysqli_num_rows($result);
}
