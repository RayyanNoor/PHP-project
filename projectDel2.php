<?php
$cnn = mysqli_connect("localhost", "root", "", "rmo");
if (!$cnn){
    echo "Error in the connection: " . mysqli_connect_error();
    exit();
}

if (isset($_GET["product_id"])) {
    $product_id = mysqli_real_escape_string($cnn, $_GET["product_id"]); 
   
    $sqldelPro = "DELETE FROM cart WHERE product_id='$product_id'";
    if (!mysqli_query($cnn, $sqldelPro)) {
        echo "An error occurred";
        exit();
    }
    
    $sql = "DELETE FROM product WHERE product_id='$product_id'";
    
    if (mysqli_query($cnn, $sql)) {
        header("Location: admin.php");
        exit();
    } else {
        echo "An error occurred while deleting !!";
    }
} else {
    echo "Product ID not provided.";
}
?>
