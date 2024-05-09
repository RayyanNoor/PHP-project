<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>

<body style="background-color:#C99383;">
  <style>
    .navbar-nav .nav-link {
      font-size: medium;
      color: #C99383;
    }

    .navbar-nav .nav-link:hover {
      color: #F0D7D1;
      font-size: medium;
    }

    #productTable {
      background-color: #C99383;
      color: #C99383;
    }

    #productTable th {
      background-color: #6B4A3F;
      color: #F0D7D1;
    }

    #productTable td {
      background-color: #F0D7D1;
    }

    #productTable .btn {
      background-color: #C99383;
      color: #F0D7D1;
      border-color: #542e23;
    }

    #productTable .btn:hover {
      background-color: #C99383;
      border-color: #C99383;
    }

    .btn-no-radius {
      border-radius: 0;
    }
  </style>
  <nav class="navbar navbar-expand-lg sticky-sm-top" style=" background-color: #6B4A3F">
    <div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-2 col-md-2">
      <a class="navbar-brand">
        <img src="logoo.png" alt="rastaurant logo" class="img-fluid" style="max-width:50%">
   </a>
  </div>
  <div class="col-8 col-md-10 text-end">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
        <span class="navbar-toggler-icon"></span></button>
      <div class="collapse navbar-collapse ml-auto" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addProduct.php">Add product </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manageUser.php">Manage users </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="logOut.php">Log out </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid py-4 " style="height: 100vh;" id="productTable">
    <div class="table-responsive">
      <table class="table table-striped caption-top">
        <caption style="font-size:24px; font-weight:bold">List of products</caption>
        <thead>
          <tr>
            <th>PRODUCT ID</th>
            <th>PRODUCT NAME</th>
            <th>PRODUCT DESCRIPTION</th>
            <th>PRICE</th>
            <th>MEAL TYPE</th>
            <th>PRODUCT IMAGE</th>
            <th>ACTIONS</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">

          <?php
          session_start();
          $cnn = mysqli_connect("localhost", "root", "", "rmo");
          if (!$cnn) {
            echo "Error in connection: ";
            exit();
          }

          $sql = "SELECT * from product";

          $result = mysqli_query($cnn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row["product_id"] . "</td>";
              echo "<td>" . $row["product_name"] . "</td>";
              echo "<td>" . $row["product_description"] . "</td>";
              echo "<td>" . $row["price"] . " $</td>";
              echo "<td>" . $row["meal_type"] . " </td>";
              echo "<td><img src='" . $row["product_image"] . "' style='max-width: 100px; max-height: 100px;' /></td>";
              echo "<td><button type='button' class='btn btn-no-radius '  onclick=\"window.location.href='projectDel2.php?product_id=" . $row["product_id"] . "'\" >Delete</button>
                            <button type='button' class='btn btn-no-radius ' onclick=\"window.location.href='updateProduct.php?product_id=" . $row["product_id"] . "'\">Update</button></td></tr></tbody>";
            }
          } else {
            echo "No data returned..";
          }
          ?>
        </tbody>
      </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    document.querySelector('a[href="logOut.php"]').addEventListener('click', function (event) {
      event.preventDefault(); 
      var confirmLogout = confirm("Are you sure you want to log out?");
      if (confirmLogout) {
        window.location.href = this.getAttribute('href');
      } else {
      
      }
    });
  </script>
  </body>

</html>