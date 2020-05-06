<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>signup</title>
  </head>
  <body>
    
  <?php
	include "dbconnect.inc.php";
	
	if ($_SERVER['REQUEST_METHOD']!="POST") {
		header('Location:../index.php');
		exit();
	}
	
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
		//hash password for more security in databasen 
		$hashpwd= password_hash($pwd,PASSWORD_DEFAULT);

		$stmt = mysqli_prepare($conn,$query);
		mysqli_stmt_bind_param($stmt,"s",$username);
		mysqli_stmt_execute($stmt);
		//fetch data from database
		$data = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		
		//var_dump($data);
		if($data[0]['D_Username'] == $username || $data[0]['P_Username']){
			header("Location: ../signup.php?error=usernametaken&username=".$username);
			exit();
		}
		else{
			if($user == "driver"){
				//prepare and bind
				$statement = mysqli_prepare($conn,"INSERT INTO drivers (D_LastN, D_FirstN, D_Username, D_Password, License_Number, D_Street, D_City, D_State, D_Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				//$statement = "INSERT INTO drivers (D_LastN, D_FirstN, D_Username, D_Password, License_Number, D_Street, D_City, D_State, D_Rate) VALUES ('$fname', '$lname', '$username', '$pwd', '$lic_number', '$street', '$city', '$state', '$rating')";
				
				mysqli_stmt_bind_param($statement, "ssssssssd", $lname ,$fname, $username, $hashpwd, $lic_number, $street, $city, $state, $rating);

				mysqli_stmt_execute($statement);
				
				// close statement
				mysqli_stmt_close($statement);

				//close connection
				mysqli_close($conn);
				
				header("Location: ../index.php");
				exit();
			}else{
				//prepare and bind
				$statement = mysqli_prepare($conn,"INSERT INTO passengers (P_LastN, P_FirstN, P_Username, P_Password, P_Street, P_City, P_State, P_Rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			
				mysqli_stmt_bind_param($statement, "sssssssd", $lname ,$fname, $username, $hashpwd, $street, $city, $state, $rating);

				mysqli_stmt_execute($statement);
				
				// close statement
				mysqli_stmt_close($statement);

				//close connection
				mysqli_close($conn);
				
				header("Location: ../index.php");
				exit();
			}
		}
	} else{
		header("Location: ../signup.php");
		exit();
	}
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

