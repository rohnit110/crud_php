<?php

include 'Database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $number = htmlspecialchars($_POST['mo_num']);
    $password = htmlspecialchars($_POST['pswd']);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO user_ (username, emailId, mo_num, pswd) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $username, $email, $number, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>alert('Successfully Signed Up!')</script>";
        header("location: index.php");
    } else {
        echo "<script>alert('Registration failed!')</script>";
    }

    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="input-container">

        <div class="text-center">
            <form action="" method="post" id="register">
                <h2 class="h2 mb-3 text-dark mb-4">Registration</h2>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                    <span id="check"></span>
                </div>
                <div class="form-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                    <span id="check_e"></span>
                </div>
                <div class="form-group mb-3">
                    <input type="number" class="form-control" name="mo_num" id="mo_num" placeholder="Mobile number">
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" name="pswd" id="pswd" placeholder="Password">
                </div>
                <button type="submit" id="register" name="register" class="btn rounded-pill btn-lg text-white" style="background-color: rgba(34,193,195,1);">Signup</button>
                <a href="index.php"><button type="button" class="btn rounded-pill btn-lg text-light" style="background-color: rgba(34,193,195,1);">Login</button></a>
            </form>
        </div>
        <script src="valid_register.js"></script>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#username').keyup(function() {
            var username = $(this).val();

            $.ajax({
                url: 'index_username.php',
                method: "POST",
                data: {
                    user_name: username
                },
                success: function(data) {
                    if (data != 0) {

                        $('#check').html('<span class="h6 text-danger">Username Exists</span>');
                        $("button[type='submit']").prop("disabled", true);
                    } else {
                        $('#check').html('<span class="h6 text-success">Username available</span>');
                        $("button[type='submit']").prop("disabled", false);
                    }
                },
                error: function() {}
            });
        });

        $('#email').keyup(function() {
            var email = $(this).val();

            $.ajax({
                url: 'email_val.php',
                method: "POST",
                data: {
                    emailid: email
                },
                success: function(data) {
                    if (data != 0) {
                        $('#check_e').html('<span class="h6 text-danger">Email Exists</span>');
                        $("button[type='submit']").prop("disabled", true);
                    } else {
                        $('#check_e').html('<span class="h6 text-success">Email available</span>');
                        $("button[type='submit']").prop("disabled", false);
                    }
                },
                error: function() {}
            });
        });
    });
</script>