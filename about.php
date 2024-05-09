<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .navbar-nav .nav-link {
      font-size: medium;
      color: #C99383;
    }

    .navbar-nav .nav-link:hover {
      color: #F0D7D1;
      font-size: medium;
    }

    .btn-no-radius {
      border-radius: 0;
    }
    .go-back a {
  font-size: medium;
  color: #F0D7D1; 
  text-decoration: none; 
  padding: 15px;
}

.go-back a:hover {
  color: #C99383;
}
  </style>
</head>

<body style="background-color:#C99383;">

<nav class="navbar navbar-expand-lg sticky-sm-top" style="background-color: #6B4A3F;">
    <div class="container-fluid">
      <div class="row align-items-center">

        <div class="col-2 col-md-2">
          <a class="navbar-brand">
            <img src="logoo.png" alt="restaurant logo" class="img-fluid" style="max-width:50%">
          </a>
        </div>
        <div class="col-2 col-md-2">
          <img src="last.gif" class="sm" alt="..." style="width: 120%;">
        </div>
        <div class="col-4 col-md-4">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home </a>
          </li>
          <li class="nav-item">
            <a class="nav-link "  href="cart.php">Cart</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="about.php">About Us </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logOut.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="col-4 col-md-4 text-end">
   <div class="go-back">
   <a href="home.php" >Don't Hesitate, Choose Your Meal Now</a>
 
   </div>
 </div>

     </nav>
  <div class="container my-5 ">
    <div class="row justify-content-start">
      <div class="col-lg-6 ">
        <h1 class="text-center mb-4" style="color:#542e23;">A New Era of Hospitality</h1>
        <p style="color:#542e23; font-size:larger">It's Friday night; you're en route to a much-needed evening out on the town, but instead of heading to a crowded restaurant, you find yourself in a candlelit RMO, surrounded by stunning contemporary art and furniture. A chef is sharing the inspiration behind her dishes; and 90s Sudanese music is playing quietly over the low hum of laughter. The vibe is just right.
          <strong>This is RMO.</strong> We take over luxury apartments and members-only clubs to host intimate dining events with chefs from the world's best restaurants. Pull up a seat at the chef's table, we can't wait to host you.
        </p>
        

      </div>
      <div class="col-lg-6">
        <div id="navbarCarousel" class="carousel slide navbar-carousel" data-bs-ride="carousel" style="margin-top:10px">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="about.gif" class="d-block w-100" alt="...">
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <footer class="fixed-bottom" style="background-color: #6B4A3F; color: white;">
      <div class="container-fluid d-flex justify-content-between mt-0 col-md-12">
        <div style="padding-top: 10px;">
          <p>&copy; 2024 - All rights reserved</p>
        </div>
        <div style="text-align: right;" class="mb-3">
          <span style="margin-right: 10px;">Follow & contact us:</span>
          <a href="https://twitter.com/Ryyan_noor?t=6p37eqaqrxUo9NXR5bWTvw&s=09" target="_blank" style="color: white;"><i class="bi bi-twitter" style="font-size: 25px;"></i></a>
          <a href="https://www.instagram.com" target="_blank" style="color: white;"><i class="bi bi-instagram" style="font-size: 25px; margin-left: 10px;"></i></a>
          <a href="https://www.facebook.com" target="_blank" style="color: white;"><i class="bi bi-facebook" style="font-size: 25px; margin-right: 10px; margin-left: 10px;"></i></a>
        </div>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
    document.querySelector('a[href="logOut.php"]').addEventListener('click', function (event) {
      event.preventDefault(); 
      var confirmLogout = confirm("Are you sure you want to log out?");
      if (confirmLogout) {
        window.location.href = this.getAttribute('href'); 
      } else {
       
      }
    });
  </script>
  </body>

</html>
