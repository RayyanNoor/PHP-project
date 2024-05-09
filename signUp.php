<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up page</title>
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

        .btn-no-radius {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="p-5 rounded form-container" id="signUp">
                    <div class="text-center mb-5">
                        <img class="img-fluid" src="logoo.png" height="250" alt="restaurant logo">
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="Name2" placeholder="Enter your full name" required>
                        <label for="Name2">Enter your full name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="Email" placeholder="Enter your Email" required>
                        <label for="Email">Enter your Email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password2" placeholder="Enter your Password" minlength="8" required>
                        <label for="password2">Enter your Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="passwordconf" class="form-control" id="password3" placeholder="Confirm your Password" required>
                        <label for="password3">Confirm your Password</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" name="signupBtn" class="btn btn-primary btn-no-radius">Sign up</button>
                        <button type="reset" class="btn btn-secondary btn-no-radius">Clean</button>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>

    <?php
    $cnn = mysqli_connect("localhost", "root", "", "rmo");
    if (!$cnn) {
        echo "Error in the connection: ";
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordconf = $_POST["passwordconf"];

        if (strlen($name) < 3) {
            echo "<script>alert('Name must be at least 3 characters long');</script>";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address');</script>";
        } else if (strlen($password) < 8 || !preg_match("#[A-Z]#", $password)) {
            echo "<script>alert('Password must be at least 8 characters long and contain at least one capital letter');</script>";
        } else if ($password !== $passwordconf) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            $sql = "SELECT id FROM users WHERE name='$name'";
            $result = mysqli_query($cnn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo "<script> alert('$name is already registered');</script>";
            } else {

                $hashed = md5($password);
                $sql = "INSERT INTO users(name, email, password) VALUES ('$name','$email','$hashed')";
                if (mysqli_query($cnn, $sql)) {
                    echo "<script>alert('$name is registered successfully');</script>";
                    header("refresh:0; url=index.php");
                } else {
                    echo "<script>alert('Error in adding new information..');</script>";
                }
            }
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
