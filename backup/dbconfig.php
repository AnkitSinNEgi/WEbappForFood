<?php
	$conn = new mysqli("localhost","root","root","karyashaladb");
	if($conn->connect_error) {
		die('Please try again later');
	}
?>