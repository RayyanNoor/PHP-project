<?php
session_start();

/* if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["userType"] !== "user") {
    header("Location: index.php");
    exit();
} */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $product_id = $_POST['product_id'];

    $cnn = mysqli_connect("localhost", "root", "", "rmo");
    if (!$cnn) {
        echo "Error in connection: ";
        exit();
    }

    $check = "SELECT * FROM cart WHERE id = $user_id AND product_id = $product_id";

    $result = mysqli_query($cnn, $check);

    if (mysqli_num_rows($result) == 0) {
        $sql= "INSERT INTO cart (id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($cnn, $sql);
    }

    header("Location: home.php");
    exit();
} else {
    header("Location: home.php");
    exit();
}
?>