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
    
    <title>Drivers</title>
  </head>
  <body>
    <?php
      session_start();
      if(!isset($_SESSION["D_Username"])) {
        header('Location:index.php');
        exit();
      }
      
      $usr=$_SESSION["D_Username"];
     
    ?>
    <nav class="navbar navbar-dark bg-dark">
      <div class="collapse column" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h5 class="text-white h4">Driver Profile</h5>
          <p><a class="text-white my-2 my-sm-0" href="driver-profile.php">Profile</a></p>
          <!-- Trigger the modal with a button -->
          <p><a class="text-white my-2 my-sm-0 deleteModal" data-toggle="modal" data-target="#deleteModal">Delete account</a></p>
                
          <!-- Modal -->
          <div id="deleteModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-body">
                  <form action="includes/driverdeleteaccount.inc.php" method="post">
                    <p class="text-center h4">Do you want to delete your account?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="col btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" name="delete-account" class="col btn btn-primary">Delete</button>
                </div>
                  </form> <!-- End of form-->
              </div>
            </div>
          </div>
          <p><a class="text-white my-2 my-sm-0" href="help.php">Help</a></p>
          <p><a class="text-white my-2 my-sm-0" href="includes/logout.inc.php">Logout</a></p>
        </div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon my-2 my-sm-0"></span>
      </button>
      <a class="navbar-brand h3 text-white"><i class="fas fa-car ml-lg-2"></i> GottaGo</a>
    </nav>

    <div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">Welcome <?php echo $usr; ?></h1>
        </div>
    </div>

    <div>
        <p class="fixed-bottom bg-dark py-4 text-white text-center m-0">Copyright 2020</p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>