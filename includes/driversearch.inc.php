<?php
    include "dbconnect.inc.php";

    session_start();
    if (!isset($_SESSION["D_Username"])) {
      header('Location:../index.php');
      exit();
    }
    elseif(!isset($_GET['tripid'])){
        header("Location: ../driver-profile.php");
        exit();
    }

    $Driver_id = $_SESSION["Driver_id"];

    $query1 = "select * from passenger_trips where id = ?";
    $stmt1 = mysqli_prepare($conn,$query1);
	mysqli_stmt_bind_param($stmt1,"i",$_GET['tripid']);
    mysqli_stmt_execute($stmt1);
    $psgtrip = $stmt1->get_result()->fetch_all(MYSQLI_ASSOC);

    $Passenger_id = $psgtrip[0]['passenger_id'];
    $Depart_Street = $psgtrip[0]['Depart_Street'];
    $Depart_City = $psgtrip[0]['Depart_City'];
    $Depart_State = $psgtrip[0]['Depart_State'];
    $Arrival_Street = $psgtrip[0]['Arrival_Street'];
    $Arrival_City = $psgtrip[0]['Arrival_City'];
    $Arrival_State = $psgtrip[0]['Arrival_Stat'];
    $trip_date = $psgtrip[0]['Date'];
    $trip_time = $psgtrip[0]['Time'];

    $query2 = "insert into trips (Driver_id, Passenger_id, Depart_Street, Depart_City, Depart_State, Arrival_Street, Arrival_City, Arrival_State, Date, Time) values (?,?,?,?,?,?,?,?,?,?)";
	$stmt2 = mysqli_prepare($conn,$query2);
	mysqli_stmt_bind_param($stmt2,"iissssssss",$Driver_id,$Passenger_id,$Depart_Street,$Depart_City,$Depart_State,$Arrival_Street,$Arrival_City,$Arrival_State,$trip_date,$trip_time);
	mysqli_stmt_execute($stmt2);
    
    $query3 = "delete from passenger_trips where id = ?";
    $stmt3 = mysqli_prepare($conn,$query3);
	mysqli_stmt_bind_param($stmt3,"i",$_GET['tripid']);
    mysqli_stmt_execute($stmt3);
    
    header("Location: ../driver-profile.php");
    exit();
?>