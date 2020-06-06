
<?php
	include "dbconnect.inc.php";

	if ($_SERVER['REQUEST_METHOD']!="POST") {
		header('Location:../index.php');
		exit();
	}
	if(isset($_POST['driveraddtrip-submit'])){
		session_start();
		$userid = $_SESSION["Driver_id"];
		
		$Depart_Street = htmlspecialchars(trim($_POST['Depart_Street']));
		$Depart_City = htmlspecialchars(trim($_POST['Depart_City']));
		$Depart_State = htmlspecialchars(trim($_POST['Depart_State']));
		$Arrival_Street = htmlspecialchars(trim($_POST['Arrival_Street']));
		$Arrival_City = htmlspecialchars(trim($_POST['Arrival_City']));
		$Arrival_State = htmlspecialchars(trim($_POST['Arrival_State']));
		$trip_date = htmlspecialchars(trim($_POST['trip_date']));
		$trip_time = htmlspecialchars(trim($_POST['trip_time']));
		//echo "User: $userid Date: $trip_date Time: $trip_time";
        $query = "insert into driver_trips (Driver_id, Depart_Street, Depart_City, Depart_State, Arrival_Street, Arrival_City, Arrival_Stat, Date, Time) values (?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"issssssss",$userid,$Depart_Street,$Depart_City,$Depart_State,$Arrival_Street,$Arrival_City,$Arrival_State,$trip_date,$trip_time);
		mysqli_stmt_execute($stmt);
			
		// close statement
		mysqli_stmt_close($stmt);
		//close connection
		mysqli_close($conn);

		header("Location: ../driver-profile.php");
		exit();			

	}elseif (isset($_POST['rideraddtrip-submit'])) {
		session_start();
		$userid = $_SESSION["Passenger_id"];
		
		$Depart_Street = htmlspecialchars(trim($_POST['Depart_Street']));
		$Depart_City = htmlspecialchars(trim($_POST['Depart_City']));
		$Depart_State = htmlspecialchars(trim($_POST['Depart_State']));
		$Arrival_Street = htmlspecialchars(trim($_POST['Arrival_Street']));
		$Arrival_City = htmlspecialchars(trim($_POST['Arrival_City']));
		$Arrival_State = htmlspecialchars(trim($_POST['Arrival_State']));
		$trip_date = htmlspecialchars(trim($_POST['trip_date']));
		$trip_time = htmlspecialchars(trim($_POST['trip_time']));
        $query = "insert into passenger_trips (Passenger_id, Depart_Street, Depart_City, Depart_State, Arrival_Street, Arrival_City, Arrival_Stat, Date, Time) values (?,?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"issssssss",$userid,$Depart_Street,$Depart_City,$Depart_State,$Arrival_Street,$Arrival_City,$Arrival_State,$trip_date,$trip_time);
		mysqli_stmt_execute($stmt);
			
		// close statement
		mysqli_stmt_close($stmt);

		//close connection
		mysqli_close($conn);
		
		header("Location: ../passenger-profile.php");
		exit();
	} 
	else{
		header("Location: ../index.php");
		exit();
	}
?>