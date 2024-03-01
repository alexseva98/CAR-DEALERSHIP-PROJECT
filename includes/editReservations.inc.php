<?php
if(isset($_POST["update"])){
    $currentRes=$_GET["id"];
    $from=$_POST["starts_at"];
    $until=$_POST["ends_at"];
    require_once 'dbh.inc.php';

    mysqli_query($conn,"UPDATE reservations set
    starts_at = '".$from."', ends_at = '".$until."'
    where id = '".$currentRes."' AND NOT EXISTS (SELECT * FROM reservations WHERE starts_at < '".$from."' AND ends_at > '".$until."')");
    $result = mysqli_query($conn,"SELECT * FROM reservations WHERE id = '".$currentRes."'");
    if($result){
        header("Location: ../viewAllReservationsAD.php?upd=$currentRes");
        exit();
     }else{
         header("Location: ../editReservationsAD.php?noupd=$currentRes");
         exit();
     }
}
elseif(isset($_POST["delete"])){
    $currentRes=$_GET["id"];
    require_once 'dbh.inc.php';

    mysqli_query($conn,"DELETE FROM reservations 
    WHERE id = '".$currentRes."'");

    $result = mysqli_query($conn,"DELETE FROM reservations
    WHERE id = '".$currentRes."'");

    if($result){
        header("Location:../viewAllReservationsAD.php?del=$currentRes");
        exit();
    }else{
        header("Location:../viewAllReservationsAD.php?error=ResNotDeleted");
        exit();
    }
}
else{
    header("Location: ../signup.php");
    exit();
}
?>