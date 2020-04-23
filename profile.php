<!DOCTYPE html>
<html>
	<head>
		<title>Cookies</title>
	</head>
	<body>
		<?php
			if(!isset($_COOKIE['username'])){
				header('Location: index.php');
				exit();
			}
		?>
		<h1> Welcome <?php echo $_COOKIE['username']; ?> again </h1>
	</body>
</html>