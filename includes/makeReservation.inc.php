<?php
session_start();
if(isset($_POST["reserve"])){
    $userId=$_SESSION["userid"];
    $userID=$_SESSION["useruid"];
    $plateNum=$_GET["id"];
    $currentCarID=$_GET["carid"];
    $from=$_GET["from"];
    $until=$_GET["until"];
    require_once 'dbh.inc.php';

    $sql="INSERT INTO reservations(user_id, car_id, starts_at, ends_at) VALUES(?, ?, ?, ?) ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ssss",$userId, $currentCarID, $from, $until);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../viewYourReservationsUS.php?res= $plateNum &from=$from &until= $until");
    exit();    

}
else {
    header("Location: ../signup.php");
    exit();
}
?>
