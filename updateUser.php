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
  <title>Update User</title>
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
 
 $id = $_GET["id"];
$sql="SELECT * FROM users where id=$id";
if(mysqli_query($cnn,$sql)){
    $result = mysqli_query($cnn,$sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_array($result);
        $name= $row["name"];
        $email= $row["email"];
        $password= $row["password"];
    }
    else{
        echo "No user found";
    }
}
else{
    echo "an error occured";
}


?>

  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="updatedUser.php" method="post" class="p-5 rounded form-container" id="">
          <div class="text-center mb-5">
            <img class="img-fluid" src="logoo.png" height="250" alt="restaurant logo">
          </div>
          <div class="form-floating mb-3">

          <input type="hidden" name="id" value="<?php echo $id; ?>">
          
            <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="Name2" disabled readonly>
            <label for="Name2">NAME</label>
            
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="Email" readonly disabled>
            <label for="Email">EMAIL</label>
           
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="password" value="<?php echo $password; ?>" class="form-control" id="password2" minlength="8" required>
            <label for="password2">PASSWORD</label>
            
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="passwordconf" value="<?php echo $password; ?>" class="form-control" id="password3" required>
            <label for="password3">CONFIRM PASSWORD</label>
           
          </div>
          <div class="mt-3">
          <button type="submit" class="btn btn-primary">Update</button>
           </div>
          <br>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
   
</body>

</html>