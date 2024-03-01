<?php
require_once 'dbh.inc.php';
   $currentUid=$_GET["id"];
   // write query for users
   $sql = "SELECT * FROM users  WHERE usersUid = '$currentUid' ";
   
   // make query & get results
   $result = mysqli_query($conn,$sql);

   // fetch the resulting rows as an array
   $Users = mysqli_fetch_all($result, MYSQLI_ASSOC);
   
   // free result from memory
   mysqli_free_result($result);
   
   // close connection
   mysqli_close($conn);
   
   ?>