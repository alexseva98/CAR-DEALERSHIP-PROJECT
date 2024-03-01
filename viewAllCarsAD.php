<?php
session_start();
?>
<?php
    require 'includes/dbh.inc.php';
    if($_SESSION['userAccess'] == ''){
        header("Location:index.php?error=noLogged");
        exit();
    }
    elseif($_SESSION["userAccess"]!=="admin"){
        header("Location:UserDashboardUS.php?error=noAdminPrivileges");
        exit();
    }
?>
<head>
    <title>Admins Dashboard:Products</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
</head>
<nav>
    <ul>
        <li><a href="adminPageAD.php">Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php"  class="active">Manage Products</a></li>
        <li><a href="createCarAD.php" >Create Product</a></li>
        <li><a href="viewAllReservationsAD.php">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<?php
 if (isset($_GET["crtd"])){
    echo '<p>car with plate number: '.$_GET["crtd"].' created<p>';
}
    if (isset($_GET["upd"])){
        echo '<p>car with plate number: '.$_GET["upd"].' updated<p>';
    }
    if (isset($_GET["del"])){
        echo '<p>car with plate number: '.$_GET["del"].' deleted<p>';
    }
?>
    <body>
    <div class="container">
    <!--TABLE FOR ALL CARS -->
    <h2>ALL CARS</h2>
        <table class ="tableIndex">
            <thead>
                <tr style="cursor:default;">
                    <th>Plate Number</th>
                    <th>Fuel</th>
                    <th>Year</th>
                    <th>Brand</th>
                    <th>Automatic</th>
                    <th>Image</th>
                </tr>
                </thead>
            <?php
            $table = mysqli_query($conn,'SELECT * FROM cars');
            while ($row = mysqli_fetch_array($table)){?>
                        <tr style="cursor:pointer;" onclick="window.location='editCarAD.php?id=<?php echo $row ['plateNumber']?>'">
                            <td><?php echo $row ['plateNumber']?></td>
                            <td><?php echo $row ['fuel']?></td>
                            <td><?php echo $row ['year']?></td>
                            <td><?php echo $row ['brand']?></td>
                            <td><?php if ( $row ['automatic'] ==="1"){ echo "<p>yes</p>";}else{echo "<p>no</p>";}?></td>
                            <td><?php echo'<img src= "'. $row ['img'].'">'?></td>
                        </tr>
            <?php } ?>
        </table>
    </div>
</html>
<!-- Error checking -->
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>