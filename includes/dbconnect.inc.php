<?php
    //establish the connection to the database
	/*$conn = mysqli_connect("localhost","root","","project");

	//check if connection failed or not
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL ".mysqli_connect_error();
	}*/

	//reporting query and code errors based on flags set
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	//use try/catch blog for exception handling.
	try {
		//create a connection with mysqli($domain, $username, $password, $database)
		$conn = new mysqli("localhost", "root", "", "project");
		//avoid weird issues with strings in database
		$conn->set_charset("utf8mb4");
	} catch(Exception $e) {
		//log error into a file on server
		error_log($e->getMessage());
		exit('Error connecting to database'); //easy message for clients
	}
?>