
<?php
	include "dbconnect.inc.php";
	if ($_SERVER['REQUEST_METHOD']!="POST") {
		header('Location:../index.php');
		exit();
	}
	if(isset($_POST['driverupdate-submit'])){
		$fname = htmlspecialchars(trim($_POST['Fname'])); 
		$lname = htmlspecialchars(trim($_POST['Lname'])); 
		$lic_number = htmlspecialchars(trim($_POST['Lnumber']));
		$street = htmlspecialchars(trim($_POST['street']));
		$city = htmlspecialchars(trim($_POST['city']));
		$state = htmlspecialchars(trim($_POST['state']));
			
        session_start();
        $userid = $_SESSION["Driver_id"];

        $query = "update drivers set D_LastN='$fname', D_FirstN='$lname', License_Number='$lic_number', D_Street='$street', D_City='$city', D_State='$state' where Driver_id = ?";
		
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"i",$userid);
		mysqli_stmt_execute($stmt);
			
		// close statement
		mysqli_stmt_close($stmt);

		//close connection
        mysqli_close($conn);
            
        header("Location: ../driver-profile.php");
		exit();

	}elseif (isset($_POST['riderupdate-submit'])) {

		$fname = htmlspecialchars(trim($_POST['Fname'])); 
		$lname = htmlspecialchars(trim($_POST['Lname'])); 
		$street = htmlspecialchars(trim($_POST['street']));
		$city = htmlspecialchars(trim($_POST['city']));
		$state = htmlspecialchars(trim($_POST['state']));

		session_start();
        $userid = $_SESSION["Passenger_id"];

        $query = "update passengers set P_LastN='$lname', P_FirstN='$fname', P_Street='$street', P_City='$city', P_State='$state' where Passenger_id = ?";
		
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"i",$userid);
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