<?php
    session_start();
  
    $logInStatus="";

    if (isset($_SESSION['login_useremail'])) {
        $logInStatus="true";
    }else{
        $logInStatus="false";
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!--  KaryaShala CSS  -->
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">

    <title>KaryaShala</title>
  </head>
  <body>
    <!--  Navigation Bar  -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark fsbar">
      <a class="navbar-brand fslogo" href="index.php">KaryaShala</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php
          if ($logInStatus=="true") {
        ?>
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="hire.php">Hire</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
        <?php
          }else{
        ?>
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
        <?php
          }
        ?>
      </div>
    </nav>
      
    <!--  Cover Image with Title  -->
    <div class="card fsCover">
      <img class="card-img-top" src="assets/images/fsCover.jpg" alt="KaryaShala Cover">
      <div class="card-img-overlay title-card">
        <h1 class="lead cover-title">KaryaShala</h1>
        <br/>
        <h2 class="lead cover-sub-title">Hire the best team you can!</h2>
      </div>
    </div>
      
    <div class="container">
        <div class="row">
            <div class="col-12 text-center display-4 main-title">
                Karyashala
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12 text-center lead">
                We are far more than ‘just a recruitment agency’ because we provide a full range of recruitment and manpower services as well as support to project and workforce management including: Well-trained personnel to assist clients with their short and long-term manpower needs. Specialist training teams which can be deployed to client projects for specialist capacity building and workforce training for long and short-term projects. In-house training for clients in order to ensure that only appropriately trained and well prepared staff are deployed to employment contracts and projects.
            </div>
        </div>

        <!-- Hire page button -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <a href="hire.php" class="btn btn-primary btn-lg btn-block">Hire Now!</a>
            </div>
        </div>
    </div>

    <!--  Bootstrap JS  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>