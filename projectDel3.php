<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "user") {
    header("Location: index.php");
    exit();
}

$cnn = mysqli_connect("localhost", "root", "", "rmo");

if (!$cnn) {
    echo "Error in connection: " . mysqli_connect_error();
    exit();
}
$user_id = $_SESSION['id'];

$sqldeleteuser="DELETE FROM cart WHERE id=$user_id";
$product_id = isset($_GET["product_id"]) ? mysqli_real_escape_string($cnn, $_GET["product_id"]) : null;



$sql = "DELETE FROM cart WHERE id = $user_id AND product_id = $product_id";


if (mysqli_query($cnn, $sql)) {
    header("Location: cart.php");
    exit();
} else {
    echo "<script>alert('An error occurred while deleting the product from the cart: " . mysqli_error($cnn)."')</script>";
}
   
?>