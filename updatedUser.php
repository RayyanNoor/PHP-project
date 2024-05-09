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
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id= $_POST["id"];
    $name= $_POST["name"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $passwordconf= $_POST["passwordconf"];

    if(strlen($password) < 8 || !preg_match("#[A-Z]#", $password) ){
        echo "<script>alert('Password must be at least 8 characters long and contain at least one capital letter');</script>";
        header("refresh:0; url=updateUser.php?id=$id");
    }
    else if($password !== $passwordconf){
        echo "<script>alert('Passwords do not match');</script>";
        header("refresh:0; url=updateUser.php?id=$id");
    }
    else {

    $sql= "UPDATE users SET password='$password' WHERE id='$id'";
    if(mysqli_query($cnn,$sql)){
        echo "<script>alert('Information updated');</script>";
        header("refresh:0; url=manageUser.php?id=$id");
        exit();
    }
    else{
        echo "Error in updating: ".mysqli_error($cnn);
    }
}
}
?>