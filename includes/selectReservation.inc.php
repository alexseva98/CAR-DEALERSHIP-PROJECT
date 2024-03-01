<?php

$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="rent_a_car";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

if(!$conn){
  die("Connection failed:".mysqli_connect_error());  
}
$currentResID=$_GET["id"];
   // write query for cars
   $sql = "SELECT * FROM reservations  WHERE id = '$currentResID' ";
   
   // make query & get results
   $result = mysqli_query($conn,$sql);

   // fetch the resulting rows as an array
   $Res = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
   // free result from memory
   mysqli_free_result($result);
   
   // close connection
   mysqli_close($conn);
   
   ?>