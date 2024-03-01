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
        <li><a href="adminPageAD.php" class="active">Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php">Manage Products</a></li>
        <li><a href="createCarAD.php" >Create Product</a></li>
        <li><a href="viewAllReservationsAD.php">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<?php
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
    if (isset($_GET["upd"])){
        echo '<p>user with username: '.$_GET["upd"].' updated<p>';
    }
    if (isset($_GET["del"])){
        echo '<p>user with username: '.$_GET["del"].' deleted<p>';
    }

?>
<body>
<?php
if (isset($_GET["logeduser"])){
    if($_GET["logeduser"]=="yes"){
        echo'<p>Welcome '. $_SESSION["useruid"] . '</p>' ;
        }
    }
?>
    <div class="container">
    <!--TABLE FOR ALL USERS -->
    <h2>ALL USERS</h2>
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
            $table = mysqli_query($conn,'SELECT * FROM users');
            while ($row = mysqli_fetch_array($table)){?>
                <tr style="cursor:pointer;" onclick="window.location='editUserAD.php?id=<?php echo $row ['usersUid']?>'">
                    <td><?php echo $row ['usersFname']?></td>
                    <td><?php echo $row ['usersLname']?></td>
                    <td><?php echo $row ['usersCountry']?></td>
                    <td><?php echo $row ['usersCity']?></td>
                    <td><?php echo $row ['usersEmail']?></td>
                    <td><?php echo $row ['usersUid']?></td>
                    <td><?php if ( $row ['usersAccess'] ==="noAccess"){ echo "<p style=background-color:red;>noAccess</p>";}else{echo $row ['usersAccess'];}?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>