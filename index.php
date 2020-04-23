<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	<link rel="stylesheet" href="assets/style.css">
    <title>Index</title>
  </head>
  <body class="index">
    
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <a class="navbar-brand h3 text-white"><i class="fas fa-car ml-5"></i> GottaGo</a>
	  <form class="form-inline" action="includes/login.inc.php" method="post">
        <input class="form-control mr-sm-2" type="text" name="username" placeholder="Username" aria-label="Username" value=<?php echo isset($_GET['username']) ? $_GET['username'] : ' '?>>
        <input class="form-control mr-sm-2" type="password" name="password" placeholder="Password" arial-label="Password">
        <button class="btn btn-success mr-sm-2" type="submit" name="login-submit">Log in</button>
		<a class="btn btn-success my-2 my-sm-2" href="signup.php"><i class="far fa-user"></i>  Sign up</a>
		
      </form>
	</nav>
	
	<?php
		if(isset($_GET['error'])){
					if($_GET['error'] == 'emptyfields'){
						/*echo '<p class="error">';
						echo 'Please fill in all fields';
						echo '</p>';*/
						echo'<p class="alert alert-danger text-center mb-0 h3" role="alert">
								Please fill in all fields!
						</p>';

					} else if($_GET['error'] == 'wrongusername'){
						/*echo '<p class="error">';
						echo 'Username cannot be found';
						echo '</p>';*/
						echo'<div class="alert alert-danger text-center mb-0 h3" role="alert">
								Username cannot be found!
						</div>';
					} else{
						/*echo '<p class="error">';
						echo 'Username and Password not matched';
						echo '</p>';*/
						echo'<div class="alert alert-danger text-center mb-0 h3" role="alert">
								Username and Password do not match!
						</div>';
					}
		} else if(isset($_GET['login'])){
			echo '<p class="success">';
			echo 'Record Found!!!';
			 echo '</p>';
		}
	?>
   
    <div class="fixed-bottom">
      <p class="bg-dark py-4 text-white text-center m-0">Copyright 2020</p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>

