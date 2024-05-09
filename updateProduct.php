 <?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <style>
    body {
      background-color: #6B4A3F;
    }

    .form-container {
      background-color: #C99383;
      padding: 50px;
      margin-top: 30px;
    }

    .text-center {
      color: #6B4A3F;
    }
    .btn-primary {
  background-color: #542e23;
  border-color: #542e23;
}
.btn-primary:hover {
  background-color: #C99383;
  border-color: #C99383;
}
.btn-secondary {
  background-color: #542e23;
  border-color: #542e23;
}
.btn-secondary:hover {
  background-color: #C99383;
  border-color: #C99383;
}
  </style>
</head>

<body>
    <?php
 $cnn = mysqli_connect("localhost", "root", "", "rmo");
 if (!$cnn) {
     echo "Error in connection: ";
     exit();
 }
 
 $id = $_GET["product_id"];
$sql="SELECT * FROM product where product_id=$id";
if(mysqli_query($cnn,$sql)){
    $result = mysqli_query($cnn,$sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        $product_name= $row["product_name"];
        $product_description= $row["product_description"];
        $price= $row["price"];
        $meal_type= $row["meal_type"];
        $product_image= $row["product_image"];
    }
    else{
        echo "No user found";
    }
}
else{
    echo "an error occured";
}


?>
<div class="container mb-5 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="updatedProduct.php" method="post" class="form-container"  enctype="multipart/form-data">
          <h2 class="text-center mb-4">Add Product</h2>
          <div class="mb-3">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="text" name="product_name" value="<?php echo $product_name; ?>" class="form-control" required>
            <label for="productName" class="form-label">Product Name</label>
          </div>
          <div class="mb-3">
            <textarea name="product_description"  class="form-control"   rows="5"  required><?php echo $product_description; ?></textarea>
            <label for="" class="form-label">Product Description</label>
          </div>
          <div class="mb-3">
            <input type="number" name="price" value="<?php echo $price; ?>"  class="form-control"  step="any" required >
            <label for="productPrice" class="form-label">Price</label>
          </div>
          <div class="mb-3">
          <label for="mealType" class="form-label">Meal Type</label>
            <select name="meal_type"  class="form-select" required>
              <option disabled>Select meal type</option>
              <option value="breakfast" <?php if ($meal_type=="breakfast" ) echo "selected"; ?>>Breakfast</option>
              <option value="lunch" <?php if ($meal_type=="lunch" ) echo "selected"; ?>>Lunch</option>
              <option value="dinner" <?php if ($meal_type=="dinner" ) echo "selected"; ?>>Dinner</option>
              <option value="desserts" <?php if ($meal_type=="desserts" ) echo "selected"; ?>>Desserts</option>
              <option value="drinks" <?php if ($meal_type=="drinks" ) echo "selected"; ?>>Drinks</option>
            </select>
          </div>
          <div class="mb-3">
    <img src="<?php echo $product_image; ?>" alt="$product_image" style="max-width: 100%;"required>
</div>
          <div class="mb-3">
            <input type="file" name="product_image" class="form-control" accept="image/*" >
            <label for="fileUpload" class="form-label">Upload New Image</label>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
 
 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>

</html>