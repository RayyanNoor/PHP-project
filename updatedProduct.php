<?php 
session_start();
$cnn = mysqli_connect("localhost", "root", "", "rmo");
if (!$cnn) {
    echo "Error in connection: ";
    exit();
}
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $price = $_POST["price"];
    $meal_type = $_POST["meal_type"];

    $allowedExtensions = array('jpg', 'jpeg', 'png');
    if ($_FILES['product_image']['size'] > 0) {
        $filename = $_FILES['product_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowedExtensions)) {
            echo "<script>alert('Invalid file type. Only JPG, JPEG, and PNG files are allowed.')</script>";
        header("refresh:0; url= updateProduct.php?product_id=$product_id");

            exit();
        }

        $upload_directory = 'uploads/';
        $uploaded_image_path = $upload_directory . $filename;

       
        if (file_exists($uploaded_image_path)) {
            echo "File already exists.";
            exit();
        }

        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $uploaded_image_path)) {
            $product_image = $uploaded_image_path;
        } else {
            echo "Error moving uploaded file.";
            exit();
        }
    } else {
        $sql = "SELECT product_image FROM product WHERE product_id='$product_id'";
        $result = mysqli_query($cnn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $product_image = $row["product_image"];
        } else {
            echo "Product not found.";
            exit();
        }
    }

    
    $sql = "UPDATE product SET product_name='$product_name', product_description='$product_description', price='$price', meal_type='$meal_type', product_image='$product_image' WHERE product_id='$product_id'";
    if (mysqli_query($cnn, $sql)) {
        header("Location: admin.php?product_id=$product_id");
        exit();
    } else {
        echo "Error in updating: " . mysqli_error($cnn);
    }
}
?>
