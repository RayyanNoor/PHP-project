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
  <title>Add product</title>
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
.form-container,.form-control,.form-select,.btn-no-radius {
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
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="admin.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="addProduct.php">Add product </a>
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

  <div class="container mb-5 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form class="form-container " action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
          <h2 class="text-center mb-4">Add Product</h2>
          <div class="mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" name="p_name" class="form-control" id="productName" placeholder="Enter product name" required>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Product Description</label>
            <textarea name="p_desc" class="form-control"   rows="5" placeholder="Enter product description" required></textarea>
          </div>
          <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" name="p_price"  class="form-control" id="productPrice" step="any" placeholder="Enter product price" required >
          </div>
          <div class="mb-3">
            <label for="mealType" class="form-label">Meal Type</label>
            <select name="meal_type" class="form-select" id="mealType" required>
              <option selected>Select meal type</option>
              <option value="breakfast">Breakfast</option>
              <option value="lunch">Lunch</option>
              <option value="dinner">Dinner</option>
              <option value="desserts">Desserts</option>
              <option value="drinks">Drinks</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="fileUpload" class="form-label">Upload Image</label>
            <input type="file" name="p_image" class="form-control" id="fileUpload" required>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary btn-no-radius ">Add Product</button>
            <button type="reset" class="btn btn-secondary btn-no-radius ">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php 
$cnn = mysqli_connect("localhost", "root", "", "rmo");
if (!$cnn) {
    echo "Error in connection: ";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $p_name = $_POST["p_name"];
    $p_desc = $_POST["p_desc"];
    $p_price = $_POST["p_price"];
    $meal_type = $_POST["meal_type"];
    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if ($_FILES['p_image']['size'] > 0) {
        $filename = $_FILES['p_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowedExtensions)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.')</script>";
            exit();
        }

        $upload_directory = 'uploads/';
        $target_file = $upload_directory . basename($filename);

        if (move_uploaded_file($_FILES['p_image']['tmp_name'], $target_file)) {
            $product_image = $target_file;
        } else {
            echo "Error moving uploaded file.";
            exit();
        }
    } else {
        echo "No image uploaded.";
        exit();
    }
    $sql = "INSERT INTO product(product_name, product_description, price, meal_type, product_image) VALUES ('$p_name','$p_desc','$p_price','$meal_type', '$product_image')";
    if(mysqli_query($cnn, $sql)) {
        echo "<script>alert('$p_name is added successfully');</script>";
    } else {
        echo "<script>alert('Error in adding new information.');</script>";
    }
}
?>

 


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