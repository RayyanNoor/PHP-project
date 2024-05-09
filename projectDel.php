<?php
$cnn = mysqli_connect("localhost","root","","rmo");
if (!$cnn){
    echo "Error in the connection: ";
    exit();
}
$user_id=$_GET["id"];
$sqlDeleteFromCart = "DELETE FROM cart WHERE id = $user_id";
if (!mysqli_query($cnn, $sqlDeleteFromCart)) {
    echo "An error occurred while deleting user from cart table!";
    exit();
}
$sql= "DELETE FROM users WHERE id=$user_id";

if(mysqli_query($cnn,$sql)){
    header("Location: manageUser.php");
}
else{
    echo"An error occured while deleting !!";
}

?>