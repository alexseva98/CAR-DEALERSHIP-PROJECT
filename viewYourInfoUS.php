<?php
session_start();
?>
<?php
    require 'includes/dbh.inc.php';   
    if($_SESSION['userAccess'] == ''){
        header("Location: index.php?error=noLogged");
        exit();
    }
    elseif($_SESSION['userAccess'] == 'admin'){
        header("Location:adminPageAD.php");
        exit();
    }  
?>
<head>
    <title>My information</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">
</head>
<nav>
<ul>
    <li><a href="UserDashboardUS.php" >Home Page</a></li>
    <li><a href="viewYourReservationsUS.php">My Reservations</a></li>
    <li><a href='viewYourInfoUS.php' class="active">My Information</a></li>
    <li><a href='includes/logout.inc.php'>log out</a></li>
</ul> 
</nav>
<body>
    <div class="container">
    <!--TABLE FOR ALL USERS -->
    <h2>My Information</h2>
        <table class ="tableIndex">
            <thead>
                <tr style="cursor:default;">
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Username</th>
                </tr>
                </thead>
            <?php
            $thisUser = $_SESSION["useruid"];
            $table = mysqli_query($conn,"SELECT * FROM users WHERE usersUid = '$thisUser'");
            while ($row = mysqli_fetch_array($table)){?>
                <tr style="cursor:default;">
                    <td><?php echo $row ['usersFname']?></td>
                    <td><?php echo $row ['usersLname']?></td>
                    <td><?php echo $row ['usersCountry']?></td>
                    <td><?php echo $row ['usersCity']?></td>
                    <td><?php echo $row ['usersEmail']?></td>
                    <td><?php echo $row ['usersUid']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php
if (isset($_GET["error"])){
    if($_GET["error"]=="noAdminPrivileges"){
        echo "<p>Cant access Page due to Acces level</p>";
        }
        if($_GET["error"]=="allreadySigned"){
            echo "<p>You need to log out to enter this page</p>";
            }
}   
?>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>