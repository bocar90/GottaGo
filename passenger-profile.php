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
    
    <title>Passengers</title>
  </head>
  <body>

    <?php
      include "includes/dbconnect.inc.php";
      
      /*if ($_SERVER['REQUEST_METHOD']!="POST") {
        header('Location:index.php');
        exit();
      }*/
      session_start();
      $username=$_SESSION["P_Username"];

      $query1 = "select * from passengers where P_Username = ?";
      $stmt1 = mysqli_prepare($conn,$query1);
		  mysqli_stmt_bind_param($stmt1,"s",$username);
      mysqli_stmt_execute($stmt1);
      //fetch data from database
      $data = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);
      $userid=$data[0]['Passenger_id'];
      $_SESSION["Passenger_id"]=$userid;

      $query3 = "select * from passenger_trips where Passenger_id = ?";
      $stmt3 = mysqli_prepare($conn,$query3);
		  mysqli_stmt_bind_param($stmt3,"i",$userid);
      mysqli_stmt_execute($stmt3);
      $displaytrips = $stmt3->get_result()->fetch_all(MYSQLI_ASSOC);
    
      $query4 = "select * from driver_trips";
      $stmt4 = mysqli_prepare($conn,$query4);
      mysqli_stmt_execute($stmt4);
      $searchtrips = $stmt4->get_result()->fetch_all(MYSQLI_ASSOC);
    ?>

    <nav class="navbar navbar-dark bg-dark">
      <div class="collapse column" id="navbarToggleExternalContent">
        <div class="bg-dark p-4">
          <h5 class="text-white h4">Driver Profile</h5>
          <p><a class="text-white my-2 my-sm-0" href="driver.php">Profile</a></p>
          <p><a class="text-white my-2 my-sm-0" href="index.php">Delete account</a></p>
          <p><a class="text-white my-2 my-sm-0" href="index.php">Help</a></p>
          <p><a class="text-white my-2 my-sm-0" href="index.php">Logout</a></p>
        </div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon my-2 my-sm-0"></span>
      </button>
      <a class="navbar-brand h3 text-white"><i class="fas fa-car ml-lg-2"></i> GottaGo</a>
    </nav>  <!--end of navbar -->
    <div>
      <a class="navbar-brand h3 text-dark"><i class="fas fa-car ml-lg-3"></i> <b>GottaGo</b> Profile</a>
      <ul class="nav nav-pills m-3" id="pills-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-trips-tab" data-toggle="pill" href="#pills-trips" role="tab" aria-controls="pills-trips" aria-selected="false">Trips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-add-tab" data-toggle="pill" href="#pills-add" role="tab" aria-controls="pills-add" aria-selected="false">Add Trip</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="pills-search-tab" data-toggle="pill" href="#pills-search" role="tab" aria-controls="pills-search" aria-selected="false">Search Trips</a>
        </li>
      </ul>
    </div>  <!--end of navbar pills-->
    
    <div>
      <p class="bg-light text-muted"><i class="fas fa-caret-left"></i></p>
      <div class="row">
        <img class="img-circle rounded-circle border border-dark ml-5 mb-3" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" />
        <div class="column ml-5">
          <p class="h3"><?php echo $data[0]['P_FirstN'];?> </p>
          <p class="font-weight-bold h3"><?php echo $data[0]['P_LastN'];?></p>
          <p><span class="border border-success small px-1">ACTIVE</span></p>
        </div>
      </div>
    </div>  <!--end of profile picture and name -->

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="jumbotron jumbotron-fluid">
          <div class="container col-lg-8">
            <form action="includes/updateusers.inc.php" method="post">
              <div class="form-group">
                <label>First name</label>
                <input type="text" class="form-control" name="Fname" value="<?php echo $data[0]['P_FirstN'];?>">
              </div>
              <div class="form-group">
                <label>Last name</label>
                <input type="text" class="form-control" name="Lname" value="<?php echo $data[0]['P_LastN'];?>">
              </div>
              <div class="form-group">
                <label>Street</label>
                <input type="text" class="form-control" id="street" name="street" value="<?php echo $data[0]['P_Street'];?>">
              </div>
              <div class="form-group">
                <label>City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $data[0]['P_City'];?>">
              </div>
              <div class="form-group">
                <label>State</label>
                <input type="text" class="form-control" id="state" name="state" value="<?php echo $data[0]['P_State'];?>">
              </div>
              <p class="text-center"><button type="submit" class="btn btn-success" name="riderupdate-submit">Update</button></p>	
            </form>
          </div>
        </div>
      </div>  <!--end of pills-profile-tab -->

        <div class="tab-pane fade" id="pills-trips" role="tabpanel" aria-labelledby="pills-trips-tab">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h4 class="text-center mb-5">MY REGISTERED TRIPS</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_id</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Passenger_id</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_street</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_city</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_state</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_street</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_city</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_state</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_date</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_time</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Delete</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Edit</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($displaytrips as  $tripid => $info){
                        echo "<tr>";
                        foreach($info as $key => $value){
                          echo '<td class="text-center align-middle">'.$value."</td>";
                        }
                        echo '<td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>';
                        echo '<td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-pencil-alt"></i></a></td>';
                        echo "</tr>";
                      }
                    ?>    
                  </tbody>
                </table>
              </div>              
            </div>
          </div>
        </div> <!-- end of pills-trips-tab -->

        <!-- beginning of pills-add-tab -->
        <div class="tab-pane fade" id="pills-add" role="tabpanel" aria-labelledby="pills-add-tab">
          <div class="jumbotron jumbotron-fluid">
            <div class="container col-lg-8">
              <h1 class="text-center mb-5">Add a trip now</h1>
              <form action="includes/addtrip.inc.php" method="post">
                <div class="form-group">
                  <input type="text" class="form-control" name="Depart_Street" placeholder="Departure Street" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Depart_City" placeholder="Departure City" required>
                </div>
                <div class="form-group mt-2">
                  <input type="text" class="form-control" name="Depart_State" placeholder="Departure State" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Arrival_Street" placeholder="Arrival Street" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="Arrival_City" placeholder="Arrival City" required>
                </div>
                          <div class="form-group">
                  <input type="text" class="form-control" name="Arrival_State" placeholder="Arrival State" required>
                </div>
                          <div class="form-group">
                  <input type="text" class="form-control" name="trip_date" placeholder="MM/DD/YYYY"  onfocus="(this.type='date')" required>
                </div>
                          <div class="form-group">
                  <input type="time" class="form-control" name="trip_time" placeholder="Trip time" required>
                </div>
                <p class="text-center"><button type="submit" class="btn btn-success" name="rideraddtrip-submit">Submit</button></p>	
              </form>
            </div>
          </div>
        </div>
        <!-- end of pills-add-tab -->

        <!-- beginning pills-search-tab -->
        <div class="tab-pane fade" id="pills-search" role="tabpanel" aria-labelledby="pills-search-tab">
          <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h4 class="text-center mb-5">AVAILABLE TRIPS TO REQUEST</h4>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_id</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Driver_id</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_street</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_city</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Depart_state</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_street</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_city</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Arv_state</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_date</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Trip_time</div>
                      </th>
                      <th scope="col" class="border-0">
                        <div class=" text-uppercase text-dark text-center align-middle">Request</div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($searchtrips as  $tripid => $info){
                        echo "<tr>";
                        foreach($info as $key => $value){
                          echo '<td class="text-center align-middle">'.$value."</td>";
                        }
                        echo '<td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-plus-circle"></i></a></td>';
                        echo "</tr>";
                      }
                    ?>    
                  </tbody>
                </table>
              </div>
            </div>
          </div> <!-- end of jumbotron -->
        </div> <!-- end of pills-search-tab -->
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