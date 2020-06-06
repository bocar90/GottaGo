<?php
  include "dbconnect.inc.php";

  session_start();
        $tripid = $_SESSION['tripid'];
        if (!isset($_SESSION["D_Username"])) {
        header('Location:../index.php');
        exit();
        }
        elseif(!isset($tripid)){
          header("Location: ../driver-profile.php");
          //echo "Trtip_id not passed";
          exit();
        }

        
      if(isset($_POST['driveredittrip-submit'])){
        $Depart_Street = htmlspecialchars(trim($_POST['Depart_Street']));
        $Depart_City = htmlspecialchars(trim($_POST['Depart_City']));
        $Depart_State = htmlspecialchars(trim($_POST['Depart_State']));
        $Arrival_Street = htmlspecialchars(trim($_POST['Arrival_Street']));
        $Arrival_City = htmlspecialchars(trim($_POST['Arrival_City']));
        $Arrival_State = htmlspecialchars(trim($_POST['Arrival_State']));
        $trip_date = htmlspecialchars(trim($_POST['trip_date']));
        $trip_time = htmlspecialchars(trim($_POST['trip_time']));

        $query = "update driver_trips set Depart_Street='$Depart_Street', Depart_City='$Depart_City', Depart_State='$Depart_State', Arrival_Street='$Arrival_Street', Arrival_City='$Arrival_City', Arrival_Stat='$Arrival_State', Date='$trip_date', Time='$trip_time' where id = ?";
        
        $stmt = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"i",$tripid);
        mysqli_stmt_execute($stmt);
        
        // close statement
        mysqli_stmt_close($stmt);

        //close connection
        mysqli_close($conn);
              
        header("Location: ../driver-profile.php");
        exit();
      }
?>


