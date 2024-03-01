<?php
if(isset($_POST["update"])){
    $plateNumber=$_GET["id"];
    $fuel=$_POST["fuel"];
    $year=$_POST["year"];
    $brand=$_POST["brand"];
    $automatic=$_POST["automatic"];
    $currentCarPlate=$_GET["id"];
    $image=$_POST["image"]?"pictures/".$_POST["image"]:$_GET["img"];
    require_once 'dbh.inc.php';
    mysqli_query($conn,"UPDATE cars set
    fuel = '".$fuel."', year = '".$year."', brand = '".$brand."', automatic = '".$automatic."', img ='".$image."'
    WHERE platenumber = '".$currentCarPlate."'");
    $result = mysqli_query($conn,"SELECT * FROM cars WHERE platenumber = '".$currentCarPlate."'");
    if($result){
        header("Location: ../viewAllCarsAD.php?upd=$currentCarPlate");
        exit();
     }else{
         header("Location: ../viewAllCarsAD.php?error=carNotUpdated");
         exit();
     }
}
elseif(isset($_POST["delete"])){
    $currentCarPlate=$_GET["id"];
    require_once 'dbh.inc.php';

    mysqli_query($conn,"DELETE FROM cars 
    WHERE platenumber = '".$currentCarPlate."'");

    $result = mysqli_query($conn,"DELETE FROM cars
    WHERE platenumber = '".$currentCarPlate."'");

    if($result){
        header("Location: ../viewAllCarsAD.php?del=$currentCarPlate");
        exit();
    }else{
        header("Location: ../viewAllCarsAD.php?error=carNotDeleted");
        exit();
    }
}
else{
    header("Location: signup.php");
    exit();
}
?>