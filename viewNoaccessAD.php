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
    <title>Admins Dashboard:NoAccess</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
</head>
<nav>
    <ul>
        <li><a href="adminPageAD.php" >Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php" class="active">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php">Manage Products</a></li>
        <li><a href="createCarAD.php" >Create Product</a></li>
        <li><a href="viewAllReservationsAD.php">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<body>
   <div class="container">
       <!--TABLE FOR NO ACCESS USERS -->
        <h2>USERS WITH NO ACCESS</h2>
        <table class ="tableIndex">
            <thead>
                <tr style="cursor:default;">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Access</th>
                </tr>
            </thead>
            <?php
            $table = mysqli_query($conn,'SELECT * FROM users WHERE users.usersAccess="noAccess"');
            while ($row = mysqli_fetch_array($table)){?>
                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                        <tr style="cursor:pointer;" onclick="window.location='editUserAD.php?id=<?php echo $row ['usersUid']?>'">
                            <td><?php echo $row ['usersFname']?></td>
                            <td><?php echo $row ['usersLname']?></td>
                            <td><?php echo $row ['usersCountry']?></td>
                            <td><?php echo $row ['usersCity']?></td>
                            <td><?php echo $row ['usersEmail']?></td>
                            <td><?php echo $row ['usersUid']?></td>
                            <td><?php echo $row ['usersAccess']?></td>
                        </tr>
            <?php } ?>
        </table>
    </div>
<!-- Error checking -->
<?php
if (isset($_GET["logeduser"])){
    if($_GET["logeduser"]=="yes"){
        echo'<p>Welcome '. $_SESSION["useruid"] . '</p>' ;
        }
    }
if (isset($_GET["error"])){
    if($_GET["error"]=="noAdminPrivileges"){
        echo "<p>Cant access Page due to Acces level</p>";
        }
        if($_GET["error"]=="allreadySigned"){
            echo "<p>You need to log out to enter this page</p>";
            }

    if($_GET["error"]=="userCreated"){
        echo "<p>You added a user</p>";
        }
    }
?>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>
