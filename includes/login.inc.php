<?php
	include "dbconnect.inc.php";

	if(isset($_POST['login-submit'])){
		//left side are new variables and on the right are the form fields names
		
			/*$_SESSION["first_name"]=$_POST["Fname"];
			$_SESSION["D_Username"]=$_POST["username"];
			header("Location: ../about.php")*/

		$username = $_POST['username'];
		$pwd = $_POST['password'];
		if(empty($username) || empty($pwd)){
			header("Location: ../index.php?error=emptyfields&username=".$username);
			exit();
		}
		else{
			$query1 = "select D_Username, D_Password from drivers where D_Username = ?";
			$stmt1 = mysqli_prepare($conn,$query1);
			mysqli_stmt_bind_param($stmt1,"s",$username);
			mysqli_stmt_execute($stmt1);
			$data1 = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);

			$query2 = "select P_Username, P_Password from passengers where P_Username = ?";
			$stmt2 = mysqli_prepare($conn,$query2);
			mysqli_stmt_bind_param($stmt2,"s",$username);
			mysqli_stmt_execute($stmt2);
			$data2 = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC); 

			var_dump($data2[0]['P_Password']);

			 if($data1[0]['D_Username']==$username){
				if(password_verify($pwd,$data1[0]['D_Password'])){
					//setcookie('username', $username, time()+3600, '/');
					session_start();
					$_SESSION["D_Username"]=$username;
					header("Location: ../driver.php");
					exit();
				} else{
					header("Location: ../index.php?error=wrongpwd&username=".$username);
					exit();
				}
			}elseif($data2[0]['P_Username']==$username){
				if(password_verify($pwd,$data2[0]['P_Password'])){
					session_start();
					$_SESSION["P_Username"]=$username;
					header("Location: ../Passenger.php");
					exit();
				} else{
					header("Location: ../index.php?error=wrongpwd&username=".$username);
					exit();
				}
			} 
			else{
				header("Location: ../index.php?error=wrongusername");
				exit();
			}
			
		}
	} else{
		header("Location: ../index.php");
		exit();
	}
?>