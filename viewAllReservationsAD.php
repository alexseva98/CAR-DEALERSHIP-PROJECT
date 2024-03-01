<?php
session_start();
?>
<?php
    require 'includes/dbh.inc.php';
    if($_SESSION['userAccess'] == ''){
        header("Location: index.php?error=noLogged");
        exit();
    }
    elseif($_SESSION["userAccess"]!=="admin"){
        header("Location: UserDashboardUS.php?error=noAdminPrivileges");
        exit();
    }
?>
<head>
    <title>Admins Dashboard:Main</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
</head>
<nav>
    <ul>
        <li><a href="adminPageAD.php" >Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php">Manage Products</a></li>
        <li><a href="createCarAD.php" >Create Product</a></li>
        <li><a href="viewAllReservationsAD.php" class="active">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<body>
    <div class="container">
    <!--TABLE FOR ALL RESERVATIONS -->
    <h2 id="tableName">All Reservations</h2>
            <table class ="tableIndex">
                <thead>
                    <tr style="cursor:default;">
                        <th>ID</th>
                        <th>user_id</th>
                        <th>car_id</th>
                        <th>From</th>
                        <th>Until</th>
                    </tr>
                </thead>
            <?php
            $thisUser = $_SESSION["userid"];
            $table = mysqli_query($conn,"SELECT * FROM reservations ");
            while ($row = mysqli_fetch_array($table)){?>
                        <tr style="cursor:pointer;" onclick="window.location='editReservationsAD.php?id=<?php echo $row ['id']?>'">
                            <td><?php echo $row ['id']?></td>
                            <td><?php echo $row ['user_id']?></td>
                            <td><?php echo $row ['car_id']?></td>
                            <td><?php echo $row ['starts_at']?></td>
                            <td><?php echo $row ['ends_at']?></td>
                        </tr>
            <?php } ?>
            </table>
        </div>
<!-- Error checking -->
<?php
if (isset($_GET["upd"])){
        echo '<p>Reservation with ID: '.$_GET["upd"].' updated<p>';
    }
    if (isset($_GET["del"])){
        echo '<p>Reservation with ID: '.$_GET["del"].' deleted<p>';
    }
?>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>
