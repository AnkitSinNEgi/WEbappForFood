<?php
    session_start();

    if (!isset($_SESSION['login_useremail'])) {
        header("Location: login.php");
    }

    require_once 'dbconfig.php';
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
      </div>
    </nav>

    <?php
        $jobId = $_GET['jobId'];
        // $sql = "SELECT * FROM job inner join jobrole on job.job_role_id = jobrole.job_role_id and job.job_id = '$jobId' inner join jobrole_to_jobseeker jrtjs on jobrole.job_role_id = jrtjs.job_role_id inner join jobseeker on jrtjs.job_seeker_id = jobseeker.job_seeker_id";
        // From job table, job_id, job_role_id, job_description, job_address, job_contact
        $sql = "SELECT * FROM job WHERE job_id = '$jobId'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $jobRoleId = $row['job_role_id'];
        $jobDescription = $row['job_description'];
        $jobWorkplace = $row['job_address'];
        $jobPhonenumber = $row['job_contact'];

        // From jobrole table, job_role_id, job_role_name
        $sql = "SELECT * FROM jobrole WHERE job_role_id = '$jobRoleId'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $jobRoleName = $row['job_role_name'];

        // From jobrole_to_jobseeker table and jobseekber table, fetch job_seeker_name, job_seeker_email
        $sql = "SELECT * FROM jobrole_to_jobseeker inner join jobseeker on jobrole_to_jobseeker.job_seeker_id = jobseeker.job_seeker_id WHERE job_role_id = '$jobRoleId'";
        $result = mysqli_query($conn,$sql);
        $jobSeekersRow = mysqli_fetch_assoc($result);

    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Job Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Job Role</h4>
                                        <p><?php echo $jobRoleName; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Job Description</h4>
                                        <p><?php echo $jobDescription; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Workplace</h4>
                                        <p><?php echo $jobWorkplace; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Contact Number</h4>
                                        <p><?php echo $jobPhonenumber; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Job Seekers</h4>
                                        <?php
                                            do {
                                                echo "<p>".$jobSeekersRow['job_seeker_name']." (".$jobSeekersRow['job_seeker_email'].")</p>";
                                            } while ($jobSeekersRow = mysqli_fetch_assoc($result));
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <!--  Bootstrap JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>