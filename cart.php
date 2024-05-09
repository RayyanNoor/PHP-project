<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "user") {
  header("Location: index.php");
  exit();
}

$totalPrice = 0.00;

$user_id = $_SESSION['id'];

$cnn = mysqli_connect("localhost", "root", "", "rmo");
if (!$cnn) {
  echo "Error in connection: ";
  exit();
}

$sql = "SELECT * FROM cart WHERE id=$user_id";
$result = mysqli_query($cnn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  $product_id = $row['product_id'];
  $psql = "SELECT * FROM product WHERE product_id=$product_id";
  $productResult = mysqli_query($cnn, $psql);

  if ($productRow = mysqli_fetch_assoc($productResult)) {
    $totalPrice += $productRow['price'];
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .navbar-nav .nav-link {
      font-size: medium;
      color: #C99383;
    }

    .navbar-nav .nav-link:hover {
      color: #F0D7D1;
      font-size: medium;
    }

    .card-deck {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }

    .card {
      width: 18rem;
      margin: 1rem;
      border-radius: 0;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card-img-top {
      border-top-left-radius: 0;
      border-top-right-radius: 0;
      max-height: 200px;
      object-fit: cover;
    }

    .card-body {
      background-color: #fff5ee;
    }
    .card-footer {
      background-color: #fff5ee;
    }

    .btn-no-radius {
      border-radius: 0;
    }

    .product-container {
      padding-bottom: 60px;
    }

    .total-price {
      font-size: medium;
      font-weight: bold;
      color:#F0D7D1;
  text-decoration: none;
      padding: 15px;
    }
    
  </style>
</head>

<body>

<nav class="navbar navbar-expand-lg sticky-sm-top" style="background-color: #6B4A3F;">
    <div class="container-fluid">
      <div class="row align-items-center">
       
        <div class="col-2 col-md-2">
          <a class="navbar-brand">
            <img src="logoo.png" alt="restaurant logo" class="img-fluid" style="max-width:50%">
          </a>
        </div>
        <div class="col-2 col-md-2">
          <img src="last.gif" class="sm" alt="..." style="width: 120%;">
        </div>
        <div class="col-4 col-md-4 text-end">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logOut.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-4 col-md-4 text-end">
   
      <div class="total-price">
        <p>Total Price: <?php echo $totalPrice; ?> $</p>
      </div>
    </div>
  </nav>
  <div class="container product-container">
    <div class="card-deck">

      <?php
      mysqli_data_seek($result, 0);

      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $product_id = $row['product_id'];
          $psql = "SELECT * FROM product WHERE product_id=$product_id";
          $productResult = mysqli_query($cnn, $psql);

          if ($productRow = mysqli_fetch_assoc($productResult)) {
      ?>
            <div class="card">
              <img src="<?php echo $productRow["product_image"]; ?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $productRow["product_name"]; ?></h5>
                <p class="card-text"><?php echo $productRow["product_description"]; ?></p>
                <p class="card-text"><?php echo $productRow["price"]; ?> $</p>
                <p class="card-text"><?php echo $productRow["meal_type"]; ?> </p>
                <p class="card-text"><?php echo date('Y-m-d',strtotime($productRow["release_date"])); ?> </p>
              </div>
              <div class="card-footer text-center">
                <form action="projectDel3.php" method="GET">
                  <input type="hidden" name="product_id" value="<?php echo $productRow['product_id']; ?>">
                  <button type="submit" class="btn btn-primary btn-no-radius">Delete</button>
                </form>
              </div>
            </div>
          <?php
          }
        }
      } else {
        echo "No products in the cart.";
      }
      mysqli_close($cnn);
      ?>
    </div>
  </div>
  <footer class="fixed-bottom " style="background-color: #6B4A3F; color: white;">
    <div class="container-fluid d-flex justify-content-between mt-0 col-md-12">
      <div style="padding-top: 10px;">
        <p>&copy; 2024 - All rights reserved</p>
      </div>
      <div style="text-align: right;" class="mb-3">
        <span style="margin-right: 10px;">Follow & contact us:</span>
        <a href="https://twitter.com/Ryyan_noor?t=6p37eqaqrxUo9NXR5bWTvw&s=09" target="_blank" style="color: white;"><i class="bi bi-twitter" style="font-size: 25px;"></i></a>
        <a href="https://www.instagram.com" target="_blank" style="color: white;"><i class="bi bi-instagram" style="font-size: 25px; margin-left: 10px;"></i></a>
        <a href="https://www.facebook.com" target="_blank" style="color: white;"><i class="bi bi-facebook" style="font-size: 25px; margin-right: 10px; margin-left: 10px;"></i></a>
      </div>
    </div>
  </footer>

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
