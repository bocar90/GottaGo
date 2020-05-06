<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
	<link rel="stylesheet" href="/assets/style.css">

    <title>Sign up</title>
  </head>
  <body>
  	<nav class="navbar navbar-dark bg-dark">
		<a class="navbar-brand h3 text-white"><i class="fas fa-car ml-lg-5"></i> GottaGo</a>
	</nav>

		<?php
			/*if ($_SERVER['REQUEST_METHOD']!="POST") {
				header('Location:index.php');
				exit();
			}*/
			if(isset($_GET['error'])){
				if($_GET['error'] == 'usernametaken'){
					echo'<p class="alert alert-danger text-center mb-0 h3" role="alert">
								Username already exists, please enter another!
						</p>';
				}
			}
		?>


	<div class="card">
		<div class="row no-gutters">
		  <div class="col-md-6 m-lg-4 "> 
			<img src="images/signup.jpg" class="card-img h-auto mr-5" alt="...">
			<h1 class="mt-lg-3">Drive with GottaGo</h1>
			<h1 class="mt-lg-3">Earn money on your schedule</h1>
			<h1 class="mt-lg-3">Be your own boss</h1>
			<p class="font-weight-bold h3 mt-lg-5">GottaGo</p>
		  </div>
		  <div class="col-md-8 col-lg-4 ml-lg-5 bg-light">
			<h1 class="text-center">Sign up now</h1>
			<div class="card-body">
				<form action="includes/signup.inc.php" method="post">
					<div class="form-group row">
						<div class="col">
							<input type="text" class="form-control" name="Fname" placeholder="First name" required>
						</div>
						<div class="col">
							<input type="text" class="form-control" name="Lname" placeholder="Last name" required>
						</div>
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="Username" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="password" name="password" placeholder="Create Password" required>
					</div>
					<p class="inline">I am a: 
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="driver" name="user" class="custom-control-input" value="driver">
						<label class="custom-control-label" for="driver">Driver</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="passenger" name="user" class="custom-control-input" value="passenger">
						<label class="custom-control-label" for="passenger">Passenger</label>
					</div>
					</p>
					<div class="form-group mt-2">
						<input type="text" class="form-control" id="Lnumber" name="Lnumber" placeholder="Driver License Number" disabled="disabled">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="street" name="street" placeholder="Street" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="city" name="city" placeholder="City" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="state" name="state" placeholder="State" required>
					</div>
					<p class="text-center"><button type="submit" class="btn btn-success" name="signup-submit">Submit</button></p>	
				</form>
				<p class="mt-4">Have an account? <a href="index.php"> Log In</a></p>
				<p class="font-weight-bold"><a><i class="fas fa-car"></i> GottaGo</a></p>
			</div>
		  </div>
		</div>
	</div>

	<div>
      	<p class="bg-dark py-4 text-white text-center m-0">Copyright 2020</p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	
	<!-- Enable/Disable text field based on radio option -->
	<script type="text/javascript">
    $(function () {
        $("input[name='user']").click(function () {
            if ($("#driver").is(":checked")) {
                $("#Lnumber").removeAttr("disabled");
                $("#Lnumber").focus();
            } else {
                $("#Lnumber").attr("disabled", "disabled");
            }
        });
    });
</script>

  </body>
</html>
