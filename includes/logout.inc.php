<?php

	/* Delete all elements in $_SESSION
		$_SESSION=[];
		Destroy session
		$_SESSION_DESTROY*/

	if(!isset($_SESSION['username'])){
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
