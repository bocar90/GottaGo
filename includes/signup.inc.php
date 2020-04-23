
<?php
	include "dbconnect.inc.php";
	
	if(isset($_POST['signup-submit'])){
		
			$fname = $_POST['Fname'];
			$lname = $_POST['Lname'];
			$username =$_POST['username'];
			$pwd = $_POST['password'];
			$user = $_POST['user'];
			$lic_number = $_POST['Lnumber'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$rating = 5.0;

		if($user === "driver")
		{
			$query = "select D_Username from drivers where D_Username = ?";
		}	
		else
		{
			$query = "select P_Username from passengers where P_Username = ?";
		}
		
		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"s",$username);
		mysqli_stmt_execute($stmt);
		//fetch data from database
		$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		
		//var_dump($data);
		if($data[0]['D_Username'] == $username){
			header("Location: ../signup.php?error=usernametaken&username=".$username);
			exit();
		}
		else{
			//prepare and bind
			$statement = mysqli_prepare($conn,"INSERT INTO drivers (D_LastN, D_FirstN, D_Username, D_Password, License_Number, D_Street, D_City, D_State, D_Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			//$statement = "INSERT INTO drivers (D_LastN, D_FirstN, D_Username, D_Password, License_Number, D_Street, D_City, D_State, D_Rate) VALUES ('$fname', '$lname', '$username', '$pwd', '$lic_number', '$street', '$city', '$state', '$rating')";
			
			mysqli_stmt_bind_param($statement, "ssssssssd",$fname, $lname, $username, $pwd, $lic_number, $street, $city, $state, $rating);

			mysqli_stmt_execute($statement);
			
			// close statement
			mysqli_stmt_close($statement);

			//close connection
			mysqli_close($conn);
			
			header("Location: ../signup.html");
			exit();

		}
	} else{
		header("Location: ../signup.html");
		exit();
	}
?>