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

    <!--  Content  -->
    <div class="container">

        <!-- Posted jobs menu starts -->
        <div class="row mt-5 mb-5" data-toggle="modal" data-target="#exampleModal">
            <div class="card-columns">

                <!-- Card for posting new job -->
                <div class="card text-center" style="cursor: pointer;">
                    <div class="card-body">
                    <h5 class="card-title">Post new job</h5>
                    <p class="card-text"><i style="font-size:large;" class="fa fa-plus" aria-hidden="true"></i></p>
                    </div>
                </div>

                <!-- Posted job cards -->
                <?php
                    // Get the user email from the session
                    $userEmail = $_SESSION['login_useremail'];

                    // Get the posted jobs from the database
                    $sql = "SELECT job.job_id, jobrole.job_role_name, job.job_description, job.job_address, job.job_contact FROM job INNER JOIN jobrole ON job.job_role_id = jobrole.job_role_id WHERE job.job_user_email = '$userEmail'";
                    $result = mysqli_query($conn,$sql);

                    // Check if the user has posted any jobs
                    if (mysqli_num_rows($result) == 0) {
                        echo '<div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">No jobs posted</h5>
                                    <p class="card-text">You have not posted any jobs yet.</p>
                                </div>
                            </div>';
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $jobId = $row['job_id'];
                            $jobDescription = $row['job_description'];
                            $jobWorkplace = $row['job_address'];
                            $jobPhonenumber = $row['job_contact'];
                            $jobRole = $row['job_role_name'];

                            echo '<div class="card text-center" style="cursor: pointer;" onclick="window.location.href=\'jobdetails.php?jobId='.$jobId.'\'">
                                    <div class="card-body">
                                        <h5 class="card-title">'.$jobRole.'</h5>
                                        <p class="card-text">'.$jobDescription.'</p>
                                        <p class="card-text">'.$jobWorkplace
                                        .'<br>'.$jobPhonenumber.'</p>
                                    </div>
                                </div>';
                        }
                    }
                ?>

            </div>
        </div>
        <!-- Posted jobs menu ends -->

        <!-- Form to post new job starts -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post New Job</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-5">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <div class="form-group">
                                <label for="job-role">Job Role*</label>
                                <select class="form-control" id="job-role">
                                    <option>Select Job Role</option>
                                    <?php

                                        // Get the job roles from the database
                                        $sql = "SELECT * FROM jobrole";
                                        $result = mysqli_query($conn,$sql);

                                        // Check if the user has posted any jobs
                                        if (mysqli_num_rows($result) == 0) {
                                            echo '<option>No job roles available</option>';
                                        } else {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $jobRoleId = $row['job_role_id'];
                                                $jobRoleName = $row['job_role_name'];

                                                echo '<option value="'.$jobRoleId.'">'.$jobRoleName.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="job-description">Job Description*</label>
                                <textarea class="form-control" id="job-description" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="job-workplace">Place of work* (address)</label>
                                <textarea class="form-control" id="job-workplace" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="job-phonenumber">Phone no for coordination*</label>
                                <input type="phone" class="form-control" id="job-phonenumber" placeholder="9198989898">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submit-job">Submit</button>
            </div>
            </div>
        </div>
        </div>
        <!-- Form to post new job ends -->

    </div>

    <!--  Bootstrap JS  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $("#submit-job").click(function(){
                var jobRole = $('#job-role').find(":selected").text();
                var jobDescription = $('#job-description').val();
                var jobWorkplace = $('#job-workplace').val();
                var jobPhonenumber = $('#job-phonenumber').val();
                // If they're empty, don't submit
                if(jobRole == "" || jobDescription == "" || jobWorkplace == "" || jobPhonenumber == ""){
                    alert("Please fill in all the fields");
                }
                else{
                    $.ajax({
                        url: "apis/postjob.php",
                        type: "POST",
                        data: {
                            jobRole: jobRole,
                            jobDescription: jobDescription,
                            jobWorkplace: jobWorkplace,
                            jobPhonenumber: jobPhonenumber
                        },
                        success: function(data){
                            if(data == "200")
                                location.reload();
                            else
                                alert("Error in posting job");
                        },
                        error: function(data){
                            alert("Error in posting job");
                        }
                    });
                }
            });
        });
    </script>
  </body>
</html>