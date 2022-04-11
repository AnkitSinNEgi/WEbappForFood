<?php
    session_start();

    //require 'dbconfig.php';
    $conn = new mysqli("localhost","root","root","karyashaladb");
    if($conn->connect_error) {
       echo '500';
    }

    // Get data from post jobRole, jobDescription, jobWorkplace, jobPhonenumber and sanitize it before inserting into database
    $jobRole = mysqli_real_escape_string($conn,$_POST['jobRole']);
    $jobDescription = mysqli_real_escape_string($conn,$_POST['jobDescription']);
    $jobWorkplace = mysqli_real_escape_string($conn,$_POST['jobWorkplace']);
    $jobPhonenumber = mysqli_real_escape_string($conn,$_POST['jobPhonenumber']);

    // Check if the user is logged in
    if (isset($_SESSION['login_useremail'])) {
        // Get the user email from the session
        $userEmail = $_SESSION['login_useremail'];

        // Get job role id from jobrole table
        $sql = "SELECT job_role_id FROM jobrole WHERE job_role_name = '$jobRole'";
        $result = mysqli_query($conn,$sql);

        // Check if the job role exists in the database, if doesn't exist, then return error
        if (mysqli_num_rows($result) == 0) {
            echo '301';
            $conn->close();
            exit;
        }

        $row = mysqli_fetch_assoc($result);
        $jobRoleId = $row['job_role_id'];
        
        // Insert the job details into the database
        $sql = "INSERT INTO job (job_user_email, job_role_id, job_description, job_address, job_contact) VALUES ('".$userEmail."', '$jobRoleId', '$jobDescription', '$jobWorkplace', '$jobPhonenumber')";
        if ($conn->query($sql) === TRUE) {
            // Return success ok 200
            echo '200';
        } else {
            // Return error 300
            echo '300';
        }
    } else {
        // Return error 400
        echo '400';
    }

    $conn->close();

?>