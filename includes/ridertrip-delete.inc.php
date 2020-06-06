<?php
    include "dbconnect.inc.php";

    session_start();
    if (!isset($_SESSION["P_Username"])) {
      header('Location:../index.php');
      exit();
    }
    elseif(!isset($_GET['tripid'])){
        header("Location: ../passenger-profile.php");
        exit();
    }
    echo $_GET['tripid'];
    $query = "delete from passenger_trips where id = ?";
    $stmt = mysqli_prepare($conn,$query);
	mysqli_stmt_bind_param($stmt,"i",$_GET['tripid']);
    mysqli_stmt_execute($stmt);
    header("Location: ../passenger-profile.php");
    exit();
?>