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
      include "includes/dbconnect.inc.php";
      session_start();
      $username=$_SESSION["D_Username"];

      $query1 = "select * from drivers where D_Username = ?";
      $stmt1 = mysqli_prepare($conn,$query1);
		  mysqli_stmt_bind_param($stmt1,"s",$username);
      mysqli_stmt_execute($stmt1);
      //fetch data from database
      $data = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);
      $userid=$data[0]['Driver_id'];
      $_SESSION["Driver_id"]=$userid;

      
      $query2 = "select * from vehicles where Driver_id = ?";
      $stmt2 = mysqli_prepare($conn,$query2);
		  mysqli_stmt_bind_param($stmt2,"s",$userid);
      mysqli_stmt_execute($stmt2);
      $vehicle = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
    ?>

    <nav class="navbar navbar-dark bg-dark">
       
        <div class="collapse column" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
              <h5 class="text-white h4">Driver Profile</h5>
              <p><a class="text-white my-2 my-sm-0" href="index.php">Profile</a></p>
              <p><a class="text-white my-2 my-sm-0" href="index.php">Delete account</a></p>
              <p><a class="text-white my-2 my-sm-0" href="index.php">Help</a></p>
              <p><a class="text-white my-2 my-sm-0" href="index.php">Logout</a></p>
            </div>
        </div>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon my-2 my-sm-0"></span>
        </button>
        <a class="navbar-brand h3 text-white"><i class="fas fa-car ml-lg-2"></i> GottaGo</a>
    </nav>
    <div>
        <a class="navbar-brand h3 text-dark"><i class="fas fa-car ml-lg-3"></i> <b>GottaGo</b> Profile</a>
        <ul class="nav nav-pills m-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-document-tab" data-toggle="pill" href="#pills-document" role="tab" aria-controls="pills-document" aria-selected="false">Manage Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-vehicle-tab" data-toggle="pill" href="#pills-vehicle" role="tab" aria-controls="pills-vehicle" aria-selected="false">Vehicles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-trips-tab" data-toggle="pill" href="#pills-trips" role="tab" aria-controls="pills-trips" aria-selected="false">Trips</a>
            </li>
        </ul>
    </div>
    
    <div>
        <p class="bg-light text-muted"><i class="fas fa-caret-left"></i></p>
        <div class="row">
            <img class="img-circle rounded-circle border border-dark ml-5 mb-3" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" />
            <div class="column ml-5">
                <p class="h3"><?php echo $data[0]['D_FirstN'];?> </p>
                <p class="font-weight-bold h3"><?php echo $data[0]['D_LastN'];?></p>
                <p><span class="border border-success small px-1">ACTIVE</span></p>
            </div>
        </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <form action="includes/signup.inc.php" method="post">
                        <div class="form-group row">
                            <div class="col">
                                <label>First name</label>
                                <input type="text" class="form-control" name="Fname" value="<?php echo $data[0]['D_FirstN'];?>">
                            </div>
                            <div class="col">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="Lname" value="<?php echo $data[0]['D_LastN'];?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $data[0]['D_Username'];?>">
                        </div>
                        
                        <div class="form-group mt-2">
                            <label>Driver License Number</label>
                            <input type="text" class="form-control" id="Lnumber" name="Lnumber" value="<?php echo $data[0]['License_Number'];?>">
                        </div>
                        <div class="form-group">
                            <label>Street</label>
                            <input type="text" class="form-control" id="street" name="street" value="<?php echo $data[0]['D_Street'];?>">
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $data[0]['D_City'];?>">
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $data[0]['D_State'];?>">
                        </div>
                        <p class="text-center"><button type="submit" class="btn btn-success" name="signup-submit">Update</button></p>	
                    </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-document" role="tabpanel" aria-labelledby="pills-document-tab">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1>Documents</h1>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="pills-vehicle" role="tabpanel" aria-labelledby="pills-vehicle-tab">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <p><a class="btn btn-info btn-lg btn-block" href="addvehicle.php">+ Add Vehicle</a></p>
                </div>

                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" class="border-0">
                            <div class=" text-uppercase text-dark text-center align-middle">Year</div>
                          </th>
                          <th scope="col" class="border-0">
                            <div class=" text-uppercase text-dark text-center align-middle">Made</div>
                          </th>
                          <th scope="col" class="border-0">
                            <div class=" text-uppercase text-dark text-center align-middle">Model</div>
                          </th>
                          <th scope="col" class="border-0">
                            <div class=" text-uppercase text-dark text-center align-middle">Color</div>
                          </th>
                          <th scope="col" class="border-0">
                            <div class=" text-uppercase text-dark text-center align-middle">License Plate</div>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" class="border-0">
                            <div class="p-2">
                              <img src="/images/NEW2020LANDROVERRANGE.jpg" alt="car">
                              <div class="ml-3 d-inline-block align-middle">
                                <p class="mb-0 h5"> <a href="#" class="text-dark d-inline-block align-middle">NEW 2020 LAND ROVER RANGE</a></p>
                              </div>
                            </div>
                          </th>
                          <td class="border-0 text-center align-middle"><strong>$129,049</strong></td>
                          <td class="border-0 text-center align-middle"><strong>1</strong></td>
                          <td class="border-0 text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                          <td class="text-center align-middle"><strong>T762511C</strong></td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <div class="p-2">
                              <img src="/images/New2019Mercedes-BenzC-Class.jpg" alt="car">
                              <div class="ml-3 d-inline-block align-middle">
                                <p class="mb-0 h5"><a href="#" class="text-dark d-inline-block">New 2019 Mercedes C-Class</a></p>
                              </div>
                            </div>
                          </th>
                          <td class="text-center align-middle"><strong>$62,735</strong></td>
                          <td class="text-center align-middle"><strong>1</strong></td>
                          <td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                          <td class="text-center align-middle"><strong>T762511C</strong></td>
                        </tr>
                        <tr>
                          <th scope="row">
                            <div class="p-2">
                              <img src="/images/New2020HondaCR-VLXAWD-blk.jpg" alt="car">
                              <div class="ml-3 d-inline-block align-middle">
                                <p class="mb-0 h5"> <a href="#" class="text-dark d-inline-block">New 2020 Honda CR-V LX AWD</a></p>
                              </div>
                            </div>
                            <td class="text-center align-middle"><strong>$26,550</strong></td>
                            <td class="text-center align-middle"><strong>1</strong></td>
                            <td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                            <td class="text-center align-middle"><strong>T762511C</strong></td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
    

            </div>
        </div>
        <div class="tab-pane fade" id="pills-trips" role="tabpanel" aria-labelledby="pills-trips-tab">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h3><a class="text-dark my-2 my-sm-0" href="index.php">Add a trip</a></h3>
                    <h3><a class="text-dark my-2 my-sm-0" href="index.php">Edit a trip</a></h3>
                    <h3><a class="text-dark my-2 my-sm-0" href="index.php">Delete a trip</a></h3>
                    <h3><a class="text-dark my-2 my-sm-0" href="index.php">Display my trips</a></h3>
                    <h3><a class="text-dark my-2 my-sm-0" href="index.php">Search for a ride</a></h3>
                </div>
            </div>
        </div>
    </div>

    

    <div>
        <p class=" bg-dark py-4 text-white text-center m-0">Copyright 2020</p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>