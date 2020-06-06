
<?php
	include "dbconnect.inc.php";

	if(isset($_POST['add-submit'])){
		$year = htmlspecialchars(trim($_POST['year']));
		$made = htmlspecialchars(trim($_POST['made']));
		$model = htmlspecialchars(trim($_POST['model']));
		$color = htmlspecialchars(trim($_POST['color']));
		$plate = htmlspecialchars(trim($_POST['plate']));	
        session_start();
        $userid = $_SESSION["Driver_id"];

        $query = "select Plate from vehicles where Plate = ?";
		
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"s",$plate);
		mysqli_stmt_execute($stmt);
		//fetch data from database
		$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		
		//var_dump($data);
		if(empty($data[0]['Plate'])|| $data[0]['Plate']!= $plate){
            //prepare and bind
			$statement = mysqli_prepare($conn,"INSERT INTO vehicles (Year, Made, Model, Color, Plate, Driver_id) VALUES (?, ?, ?, ?, ?, ?)");
						
			mysqli_stmt_bind_param($statement, "issssi",$year, $made, $model, $color, $plate, $userid);

			mysqli_stmt_execute($statement);
			
			// close statement
			mysqli_stmt_close($statement);

			//close connection
            mysqli_close($conn);
            
            header("Location: ../driver-profile.php");
		    exit();
		}
		else{
			header("Location: ../addvehicle.php?error=platetaken&plate=".$plate);
			exit();
		}
	} else{
		header("Location: ../addvehicle.php");
		exit();
	}
?>