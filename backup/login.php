<?php
   session_start();

	if (isset($_SESSION['login_useremail'])) {
		header("Location: index.php");
	}
   
   function loginUser($email, $password){
        require_once 'dbconfig.php';
        $uemail = mysqli_real_escape_string($conn,$email);
        $upassword = md5($password);
        
        $sql = "SELECT * FROM user WHERE email = '$uemail' and password = '$upassword'";
        $result = mysqli_query($conn,$sql);
        
        $count = mysqli_num_rows($result);
        $conn->close();
        if($count == 1) {
            $_SESSION['login_useremail'] = $uemail;
            echo '<script type="text/javascript">window.location.href = "hire.php"</script>';
        }else {
            echo '<script type="text/javascript">error("Invalid email or password");</script>';
        }
   }
   
   function registerUser($name, $email, $password){
		  require_once 'dbconfig.php';
		  $uname = mysqli_real_escape_string($conn,$name);
		  $uemail = mysqli_real_escape_string($conn,$email);
		  $upassword = md5($password);
		  
		  $sql = "INSERT INTO user (name, email, password) VALUES ('$uname', '$uemail', '$upassword')";

		  if ($conn->query($sql) === TRUE) {
			echo '<script type="text/javascript">success("Registration Successful! Please Login");</script>';
		  } else {
			echo '<script type="text/javascript">error("Email already registered or unknown error. Please Retry!");</script>';
		  }
		  $conn->close();
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
	<link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/login.css">

    <title>KaryaShala | Login/Signup</title>
	
	<!--  Bootstrap JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<script>
		function error(message){
			document.write('<div class="alert alert-danger alert-dismissible fixed-bottom"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> '+message+'');
		}
		
		function success(message){
			document.write('<div class="alert alert-success alert-dismissible fixed-bottom"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> '+message+'');
		}
	</script>
  </head>
  <body>
	<!--  Navigation Bar  -->
	<nav class="navbar sticky-top navbar-expand-lg navbar-dark fsbar">
      <a class="navbar-brand fslogo" href="index.php">KaryaShala</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
      </div>
    </nav>
	
	<!-- Login body -->
	<div class="container mt-5 pt-5">
	  <div class="card mx-auto border-0">
		<div class="card-header border-bottom-0 bg-transparent">
          <h5 class="card-title">Login/Register for Karyashala</h5>
		  <ul class="nav nav-tabs justify-content-center pt-4" id="pills-tab" role="tablist">
			<li class="nav-item">
			  <a class="nav-link active text-primary" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login"
				 aria-selected="true">Login</a>
			</li>

			<li class="nav-item">
			  <a class="nav-link text-primary" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register"
				 aria-selected="false">Register</a>
			</li>
		  </ul>
		</div>

		<div class="card-body pb-4">
		  <div class="tab-content" id="pills-tabContent">
			<div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
			  <form action = "" method = "post">
				<input type="hidden" name="logintype" value="login">
				<div class="form-group">
				  <input type="text" name="email" class="form-control" id="email" placeholder="Email" required autofocus>
				</div>

				<div class="form-group">
				  <input type="password" name="password" class="form-control" id="password" id="password" placeholder="Password" required>
				</div>

				<div class="text-center pt-4">
				  <button type="submit" class="btn btn-primary">Login</button>
				</div>

				<div class="text-center pt-2">
				  <a class="btn btn-link text-primary" href="#">Forgot Your Password?</a>
				</div>
			  </form>
			</div>

			<div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
			  <form action = "" method = "post">
				<input type="hidden" name="logintype" value="register">
				<div class="form-group">
				  <input type="text" name="name" id="rname" class="form-control" placeholder="Name" required autofocus>
				</div>

				<div class="form-group">
				  <input type="email" name="email" id="remail" class="form-control" placeholder="Email" required>
				</div>

				<div class="form-group">
				  <input type="password" name="password" id="rpassword" class="form-control" placeholder="Set a password" required>
				</div>

				<div class="form-group">
				  <input type="password" name="password_confirmation" id="rpassword-confirm" class="form-control" placeholder="Confirm password" required>
				</div>

				<div class="text-center pt-2 pb-1">
				  <button type="submit" class="btn btn-primary">Register</button>
				</div>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			//if user is logging in
			if($_POST['logintype']==='login') {
				loginUser($_POST['email'], $_POST['password']);
			}
			//if the user is registering
			else if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['logintype']==='register'){
				registerUser($_POST['name'], $_POST['email'], $_POST['password']);
			}
	    }
	?>

</body>
</html>