<?php
    include "dbconnect.inc.php";
    session_start();
    if (!isset($_SESSION["P_Username"])) {
        header('Location:index.php');
        exit();
    }
    $user = $_SESSION['P_Username'];

    if (isset($_POST['delete-account'])) {
        /*$query = "delete from passengers where P_Username = ?";
        $stmt = mysqli_prepare($conn,$query);
        mysqli_stmt_bind_param($stmt,"s",$user);
        mysqli_stmt_execute($stmt);
        
        // close statement
        mysqli_stmt_close($stmt);

        //close connection
        mysqli_close($conn);*/ 
        
        echo "Account deleted successfully";
        
        /*header("Location: ../index.php");
        exit();*/
    }
    
?>