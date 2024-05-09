<?php
session_start();

$cnn = mysqli_connect("localhost", "root", "", "rmo");

if (!$cnn) {
  echo "Error in connection: ";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $password = $_POST['password'];

  $hashed = md5($password);
  $sql = "SELECT id, name, role, password FROM users WHERE name='$name'";
  $result = mysqli_query($cnn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    if ($hashed == $row['password']) {
      $_SESSION['role'] = $row['role'];
      $_SESSION['id'] = $row['id'];
      $_SESSION['loggedin'] = true;

      if ($_SESSION['role'] == 'admin') {
        header('Location: admin.php');
        exit();
      } else if ($_SESSION['role'] == 'user') {
        header('Location: home.php');
        exit();
      }
    } else {
      echo "<script>alert('Incorrect username or password.')</script>";
    }
  } else {
    echo "<script>alert('User not found.')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      background-color: #6B4A3F;
    }

    .form-container {
      background-color: #C99383;
      padding: 50px;
      margin-top: 30px;
      border-radius: 0%
    }

    .text-center {
      color: #6B4A3F;
    }

    .btn-no-radius {
      border-radius: 0;
    }
  </style>
</head>

<body>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" class="p-5 rounded form-container" id="login">
          <div class="text-center mb-5">
            <img class="img-fluid" src="logoo.png" height="250" alt="restaurant logo">
          </div>
          <h1 class="h5 mb-4 fw-bold text-center">We've got a spot reserved for you</h1>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="name" placeholder="Enter your name">
            <label for="Name">Enter your name</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" name="password" placeholder="Enter your Password" min="8">
            <label for="password">Enter your Password</label>
          </div>
          <div class="checkbox mt-3">
            <label>
              <input type="checkbox" value="Remember me">Remember me
            </label>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-lg btn-primary btn-no-radius d-block w-100" name="loginBtn" id="signIn" style="background-color:#542e23; border-color: #542e23">Sign In</button>
            <button type="button" class="btn btn-lg btn-primary btn-no-radius d-block w-100 mt-3" name="signupBtn" id="signUpbtn" style="background-color:#542e23; border-color: #542e23" onclick="window.location.href = 'signUp.php'">Sign Up</button>
            <button type="button" class="forgot-btn mt-3 form-control btn-no-radius">Forgot my password</button>
          </div>
          <br>
          <div class="forgot"></div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>