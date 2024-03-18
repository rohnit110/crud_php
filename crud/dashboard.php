<?php
session_start();
$user = $_SESSION['username'];
if (isset($user) != 0) {
} else {
    header("location: index.php");
}
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3-/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
    <style>
        body {
            background: rgb(34, 56, 195);
            background: linear-gradient(75deg, rgba(34, 56, 195, 0.5125699938178396) 0%, rgba(34, 56, 195, 0.5125699938178396) 100%);
        }
        a {
            text-decoration: none;
        }
        i {
            width: 26px;
            height: 26px;
        }
    </style>
    <title>Ecommerce</title>
</head>
<body>
    <form class="mt-3" method="get" action="">
        <nav class="navbar ms-3 me-3 navbar-expand-sm">
            <div class="container">
                <div class="d-flex col-10 justify-content-between">
                    <div class="col-3 input-group">
                        <input type="search" class="form-control-sm me-1 border-0 search" name="search" value="<?php if (isset($_GET['search'])) { echo $_GET['search'];} ?>" placeholder="Search here">
                        <input type="submit" class="btn btn-success me-2" value="Search">
                    </div>
                    <div class="col-2 ms-5">
                        <button type="button" class="btn btn-lg btn-success"><a href="add_data.php" class=" text-white ">Add</a></button>
                        <button type="button" class="btn btn-lg btn-danger"><a href="logout.php" class="text-white">Logout</a></button>
                    </div>
                </div>
            </div>
        </nav>
    </form>
    <h2 class="h1 text-center mb-3" style="color:white">Dashboard</h2>

    <?php
    include "Database/database.php";

    $result_per_page = 5;
    if (isset($_GET['result_per_page']) && is_numeric($_GET['result_per_page'])) {
        $result_per_page = $_GET['result_per_page'];
    }
    if (!isset($_GET["page"])) {
        $page = 1;
    } else {
        $page = $_GET["page"];
    }
    $start_from = ($page - 1) * $result_per_page;

    //sort
    $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'id';
    $order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

    $sql3 = "SELECT * FROM products ORDER BY $orderBy $order LIMIT $start_from, $result_per_page";
    $result = $conn->query($sql3);
    ?>
    <div class='container'>
        <table class='table text-center table-dark text-light mb-0'>
            <th class="col-2"><a class="text-light link-underline-dark" href="?orderBy=product_id&order=<?= ($orderBy === 'product_id' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Product Id</a></th>
            <th class="col-2"><a class="text-light link-underline-dark" href="?orderBy=product_name&order=<?= ($orderBy === 'product_name' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Product</a></th>
            <th class="col-2"><a class="text-light link-underline-dark" href="?orderBy=product_description&order=<?= ($orderBy === 'product_description' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Description</a></th>
            <th class="col-2"><a class="text-light link-underline-dark" href="?orderBy=price&order=<?= ($orderBy === 'price' && $order === 'ASC') ? 'DESC' : 'ASC'; ?>">Price</a></th>
            <th class="col-2">Image</th>
            <th class="col-2">Operation</th>
        </table>
    </div>
    <?php

    if (!isset($_GET["search"])) {
        echo "<div class='container'>";
        echo "<table class='table text-center table-hover table-striped'>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='container'>";
            echo "<td class='col-2'> {$row['product_id']}</td>";
            echo "<td class='col-2'>  {$row['product_name']}</td>";
            echo "<td class='col-2'>  {$row['product_description']}</td>";
            echo "<td class='col-2'>  {$row['price']}</td>"; ?>
            <td class='col-2'> <img src="Config/<?php echo $row['product_image']; ?>" alt="Product Image" style="width: 100px;"></td>
        <?php echo
            "<td class='col-2'>
            <a class=' col text-danger fw-bold' href='update.php?product_id={$row['product_id']}'> <i class='bi bi-pencil-square text-success h3'></i> </a> &nbsp;&nbsp; &nbsp;
            <a class=' collink-underline-success text-danger' href='delete.php?name={$row['product_name']}'><i class='bi bi-x-circle-fill h3'></i></a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        $searchTerm = $_GET['search'];
        $sql1 = "SELECT * FROM products WHERE CONCAT(product_name, product_description, price,product_id) LIKE '%$searchTerm%'";
        $filterdata = mysqli_query($conn, $sql1);
        echo "<div class='container'>";
        echo "<table class='table text-center table-hover table-striped'>";
        if (mysqli_num_rows($filterdata) > 0) {

            foreach ($filterdata as $row1) {
                echo "<tr class='container'>";
                echo "<td class='col-2'>  {$row1['product_id']}</td>";
                echo "<td class='col-2'> {$row1['product_name']}</td>";
                echo "<td class='col-2'>  {$row1['product_description']}</td>";
                echo "<td class='col-2'>  {$row1['price']}</td>";
                echo "<td class='col-2'> <img src='Config/{$row1['product_image']}' alt='Product Image' style='width: 100px;'></td>";
                echo "<td class='col-2'>
                        <a class=' col text-danger fw-bold' href='update.php?product_id={$row1['product_id']}'> <i class='bi bi-pencil-square text-success h3'></i> </a> &nbsp;&nbsp; &nbsp;
                        <a class=' col text-danger' href='delete.php?name={$row1['product_name']}'><i class='bi bi-x-circle-fill h3'></i></a></td>";
            }
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p class='display-5 text-center text-light mt-5'>Sorry No Data Found!</p>";
        }
    }

    if (!isset($_GET["search"]) || $_GET['search'] == '') {
        //pagination
        $sql1 = "SELECT COUNT(id) AS total FROM products";
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row['total'] / $result_per_page);

        echo "<nav class='container'>";
        echo "<ul class='pagination '>";
        echo " <div class='d-flex flex-grow-1'>";

        if ($page > 1) {
            echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=" . ($page - 1) . "&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'><</a></li>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='dashboard.php?page=$i&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'>$i</a></li>";
        }

        if ($page < $total_pages) {
            echo "<li class='page-item'><a class='page-link' href='dashboard.php?page=" . ($page + 1) . "&result_per_page=$result_per_page&orderBy=$orderBy&order=$order'>></a></li>";
        }
        echo "</div>";
        ?>
        <div class=" border border-primary bg-primary ms-2 text-light">
            <label for="page" class="form-label m-auto">Page</label>
            <select class="form-select-sm" class="" id="page" onchange="viewDataPerPage(this)">
                <option value="5" <?php if ($result_per_page == 5)
                                        echo "selected"; ?>>5</option>
                <option value="10" <?php if ($result_per_page == 10)
                                        echo "selected"; ?>>10</option>
                <option value="15" <?php if ($result_per_page == 15)
                                        echo "selected"; ?>>15</option>
                <option value="20" <?php if ($result_per_page == 20)
                                        echo "selected"; ?>>20</option>
            </select>
        </div>
        <script>
            function viewDataPerPage(page) {
                var value = page.value;
                window.location.href = "dashboard.php?result_per_page=" + value;
            }
        </script>
    <?php

        echo "</nav>";
    }
    ?>


    <?php
    $conn->commit();

    ?>
</body>

</html>