<?php

	/* Delete all elements in $_SESSION
		$_SESSION=[];
		Destroy session
		$_SESSION_DESTROY*/
	session_start();
	if(!isset($_SESSION["D_Username"]) && !isset($_SESSION['P_Username'])){ //OR: 1 || 0 = 1
		header('Location: ../index.php');
		exit();
	}else{
		//setcookie('username', '', time()-1, '/');
		$_SESSION = [];
		session_destroy();
		header('Location: ../index.php');
		exit();
	}
	
?>
