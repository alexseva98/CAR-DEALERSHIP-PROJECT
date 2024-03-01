<?php
session_start();
    require 'dbh.inc.php';
    if($_SESSION['userAccess'] == ''){
        header("Location: ../index.php?error=noLogged");
        exit();
    }
$from= $_POST["arrival"];
$until=$_POST["departure"];
$table =mysqli_query($conn,
            "SELECT  * from cars  where not exists ( select * from reservations
             where (cars.carsID = reservations.car_id )
             AND (reservations.starts_at<'".$until."') 
             AND (reservations.ends_at>'".$from."'))");

$tableJson=array();
while ($row = mysqli_fetch_array($table)){
    array_push($tableJson,array(
        'Plate Number'=>$row ['plateNumber'],
        'Fuel'=>$row ['fuel'],
        'Year'=>$row ['year'],
        'Brand'=>$row ['brand'],
        'Automatic'=>$row ['automatic'] ==="1"?'yes':'no'

    ));
};
echo json_encode($tableJson);
exit;
?>