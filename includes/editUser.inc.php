<?php
if(isset($_POST["update"])){
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $country=$_POST["country"];
    $city=$_POST["city"];
    $access=$_POST["usersAccess"]? $_POST["usersAccess"] :"";
    $currentUid=$_GET["id"];
    require_once 'dbh.inc.php';
    mysqli_query($conn,"UPDATE users set
    usersFname = '".$fname."', usersLname = '".$lname."', usersCountry = '".$country."', usersCity = '".$city."', usersAccess = '".$access."'
    WHERE usersUid = '".$currentUid."'");
    $result = mysqli_query($conn,"SELECT * FROM users WHERE usersID = '".$currentUid."'");
    if($result){
        header("Location: ../adminPageAD.php?upd=$currentUid");
        exit();
     }else{
         header("Location: ../adminPageAD.php?error=userNotUpdated");
         exit();
     }
}
elseif(isset($_POST["delete"])){
    $currentUid=$_GET["id"];
    require_once 'dbh.inc.php';

    mysqli_query($conn,"DELETE FROM users 
    WHERE usersUid = '".$currentUid."'");

    $result = mysqli_query($conn,"DELETE FROM users
    WHERE usersUid = '".$currentUid."'");

    if($result){
        header("Location: ../adminPageAD.php?del=$currentUid");
        exit();
    }else{
        header("Location: ../adminPageAD.php?error=userNotDeleted");
        exit();
    }
}
else{
    header("Location: ../signup.php");
    exit();
}
?>