<?php
session_start();

    require 'includes/dbhUS.inc.php';
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
    <title>My reservations</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">
</head>
<nav>
    <ul>
        <li><a href="UserDashboardUS.php" >Home Page</a></li>
        <li><a href="viewYourReservationsUS.php" class="active">My Reservations</a></li>
        <li><a href='viewYourInfoUS.php'>My Information</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul> 
</nav>
<body>
    <!-- Error checking -->
<?php
if (isset($_GET["error"])){
    //if($_GET["error"]=="allreadySigned"){
       // echo "<p>You need to log out to enter this page</p>";
       // }
    if($_GET["error"]=="userCreated"){
        echo "<p>You added a user</p>";
        }
    }
    if (isset($_GET["res"])){
        echo '<p>Reservation added with Plate Number : '.$_GET["res"].'from: '.$_GET["from"].' until: '.$_GET["until"]. '<p>';
    }
?>
    <div class="container">
    <!--TABLE FOR CURRENT USER -->
    <h2><?php echo' Reservations for User: '. $_SESSION["useruid"] .'</p>' ;?></h2>
            <table class ="tableIndex">
            <thead> 
                <tr style="cursor:default;">
                    <th>Plate number</th>
                    <th>From</th>
                    <th>Until</th>
                    <th>Image</th>
                </tr>
            <thead> 
            <?php
            $thisUser = $_SESSION["userid"];
            $table = $conn->query("SELECT c.plateNumber, u.usersEmail, r.starts_at, r.ends_at, c.img FROM reservations AS r INNER JOIN cars AS c ON c.carsID = r.car_id INNER JOIN users AS u
            ON u.usersID = r.user_id WHERE r.user_id = $thisUser");
            while ($row = $table->fetch(PDO::FETCH_NUM)){?>
                <tr style="cursor:default;">
                    <td><?php echo $row[0]?></td>
                    <td><?php echo $row[2]?></td>
                    <td><?php echo $row[3]?></td>
                    <td><?php echo '<img src= "'.$row[4].'">'?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>