<?php
if(isset($_POST["submit"])){
    $plateNumber=$_POST["plateNumber"];
    $fuel=$_POST["fuel"];
    $year=$_POST["year"];
    $brand=$_POST["brand"];
    $automatic=$_POST["automatic"];
    $image=$_POST["image"]?$_POST["image"]:"default.jpg";
    //input field text $img="pictures/$image.jpg";
    //input field select file
    $img="pictures/$image";
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    
    if(plateExists($conn,$plateNumber) !==false){
        header("Location: ../createCarAD.php?error=invalidplate");
        exit();
    }
    adminCreateCar($conn, $plateNumber, $fuel, $year, $brand, $automatic,$img);

}
else{
    header("Location:../createCarAD.php?error=UNKNOWN");
    exit();
}
?>