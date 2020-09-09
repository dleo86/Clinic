<?php
	$conn=mysqli_connect("localhost", "root", "", "db_range");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>