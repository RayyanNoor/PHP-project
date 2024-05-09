<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "user") {
  header("Location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
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

    .form-check-label {
      color: #6B4A3F;
      font-weight: normal;
      margin-bottom: 0;
    }

    .dropdown-menu {
      background-color: #6B4A3F;
    }

    .dropdown-menu .dropdown-item {
      color: #C99383;
    }

    .dropdown-menu .dropdown-item:hover {
      color: #F0D7D1;
      background-color: transparent;
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
      object-fit:fill;
    }

    .card-body {
      background-color: #fff5ee ;
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
  </style>
</head>

<body style="background-color:#C99383">

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
                <a class="nav-link active" aria-current="page" href="home.php">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link "  href="cart.php">Cart</a>
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
          <ul class="navbar-nav text-end">
            <li class="nav-item dropdown">
              <button class="nav-link dropdown-toggle" id="filterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sort
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterDropdown">
                <li><a class="dropdown-item" href="?filter=AZ">A-Z</a></li>
                <li><a class="dropdown-item" href="?filter=ZA">Z-A</a></li>
                <li><a class="dropdown-item" href="?filter=recent">Most recent release</a></li>
                <li><a class="dropdown-item" href="?filter=low_high">Price Lowest-Highest</a></li>
                <li><a class="dropdown-item" href="?filter=high_low">Price Highest-Lowest</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <button class="nav-link dropdown-toggle" id="mealTypeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Meal Type
              </button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mealTypeDropdown">
                <li><a class="dropdown-item" href="?meal_type=starters">Starters</a></li>
                <li><a class="dropdown-item" href="?meal_type=breakfast">Breakfast</a></li>
                <li><a class="dropdown-item" href="?meal_type=dinner">Dinner</a></li>
                <li><a class="dropdown-item" href="?meal_type=drinks">Drinks</a></li>
                <li><a class="dropdown-item" href="?meal_type=desserts">Desserts</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
     
  </nav>



  <div class="container product-container">
    <div class="card-deck">
      <?php
      $cnn = mysqli_connect("localhost", "root", "", "rmo");
      if (!$cnn) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $user_id = $_SESSION['id'];
      $sql = "SELECT * FROM cart WHERE id = $user_id";
      $result = mysqli_query($cnn, $sql);

      $cartProductIds = [];
      while ($row = mysqli_fetch_assoc($result)) {
        $cartProductIds[] = $row['product_id'];
      }

      $sql = "SELECT * FROM product WHERE 1=1";

      if (isset($_GET['filter'])) {
        $filter = $_GET['filter'];
        if ($filter === 'AZ') {
          $sql .= " ORDER BY product_name ASC";
        } elseif ($filter === 'ZA') {
          $sql .= " ORDER BY product_name DESC";
        } elseif ($filter === 'recent') {
          $sql .= " ORDER BY release_date DESC";
        } elseif ($filter === 'low_high') {
          $sql .= " ORDER BY price ASC";
        } elseif ($filter === 'high_low') {
          $sql .= " ORDER BY price DESC";
        }
      }

      if (isset($_GET['meal_type'])) {
        $mealType = $_GET['meal_type'];
        $sql .= " AND meal_type = '$mealType'";
      }
      if(isset($_GET['release_date'])){
        $releaseDate = $_GET['release_date'];
        $sql .= " AND release_date = '$releaseDate'";
      }
      $result = mysqli_query($cnn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

      ?>

          <div class="card">
            <img src="<?php echo $row["product_image"]; ?>" class="card-img-top h-100" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row["product_name"]; ?></h5>
              <p class="card-text"><?php echo $row["product_description"]; ?></p>
              <p class="card-text"><?php echo $row["price"]; ?> $</p>
              <p class="card-text"><?php echo $row["meal_type"]; ?> </p>
              <p class="card-text"><?php echo date('Y-m-d',strtotime($row["release_date"])); ?> </p>
            </div>
            <div class="card-footer text-center">
              <form method="POST" action="addToCart.php">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                <?php
                if (in_array($row['product_id'], $cartProductIds)) {
                  echo '<a href="cart.php" class="btn btn-primary btn-no-radius">In Cart</a>';
                } else {

                  echo '<button type="submit" class="btn btn-primary btn-no-radius">Add to Cart</button>';
                }
                ?>
              </form>
            </div>
          </div>

      <?php 
        }
      } else {
        echo "No data returned..";
      }
      ?>
    </div>
  </div>

  <footer class="fixed-bottom" style="background-color: #6B4A3F; color: white;">
    <div class="container-fluid d-flex justify-content-between mt-0  col-md-12">
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