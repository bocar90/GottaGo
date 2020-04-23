<?php
    //establish the connection to the database
	$conn = mysqli_connect("localhost","root","","project");

	//check if connection failed or not
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL ".mysqli_connect_error();
	}
?>