
<?php
	include "dbconnect.inc.php";
	
	if(isset($_POST['update-submit'])){
		    $fname = $_POST['Fname'];
			$lname = $_POST['Lname'];
			$username =$_POST['username'];
			$lic_number = $_POST['Lnumber'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			
        session_start();
        $userid = $_SESSION["Driver_id"];

        $query = "update drivers set D_LastN=$fname, D_FirstN=$lname, D_Username=$username, License_Number=$lic_number, D_Street=$street, D_City=$city, D_State=$state where Driver_id = ?";
		
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"i",$userid);
		mysqli_stmt_execute($stmt);
			
			// close statement
			mysqli_stmt_close($statement);

			//close connection
            mysqli_close($conn);
            
            header("Location: ../driver-profile.php");
		    exit();

	} else{
		header("Location: ../driver-profil.php");
		exit();
	}
?>