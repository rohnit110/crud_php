<?php
session_start();
include 'Database/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = ($_POST['username']);
    $password = htmlspecialchars($_POST['pswd']);

    $stmt = $conn->prepare("SELECT * FROM user_ WHERE username = ? ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['pswd'])) {
            $_SESSION['username'] = $username;
            echo "<script>alert('Successfully logged in!')</script>";
            header("Location: dashboard.php");
        } else {
            echo "<script>alert('Wrong Credentials!')</script>";
        }
    } else {
        echo "<script>alert('User not found!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>

    <title>Login</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="input-container">
        <div class="text-center">
            <form action="" method="post" name="loginform" id="loginform">
                <h2 class="h2 mb-3 text-dark">Login Here</h2>

                <div class="form-group mb-3">
                    <!-- <label for="username" class="text-start">Username</label> -->
                    <input type="text" class="form-control" placeholder="Enter username" name="username" id="username">
                    <span id="check-username"></span>
                </div>

                <div class="form-group mb-3">
                    <!-- <label for="pswd">Password</label> -->
                    <input type="password" class="form-control" name="pswd" id="pswd" placeholder="Enter Password">
                </div>

                <button type="submit" name="login" id="login" class="btn rounded-pill btn-lg text-light" style="background-color: rgba(34,193,195,1);">Login</button>

                <a href="register.php"><button type="button" class="btn rounded-pill btn-lg text-light" style="background-color: rgba(34,193,195,1);">SignUp</button></a>
            </form>
        </div>

        <script src="validation.js"></script>
    </div>
</body>

</html>