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
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
</head>
<nav>
    <ul>
        <li><a href="UserDashboardUS.php" class="active">Home Page</a></li>
        <li><a href="viewYourReservationsUS.php">Your Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul> 
</nav>
<body>
    

<?php
    // gets value sent over search form
	$from = $_POST['starts_at'];
    $until =$_POST['ends_at'];
?>
    <div class="container">
    <!--TABLE FOR available cars -->
    <h2>AVAILABLE CARS FROM: <?php echo htmlspecialchars($from)?> UNTIL: <?php echo htmlspecialchars($until)?>  </h2> 
        <table class ="tableIndex">
            <thead>
                <tr style="cursor:default;">
                    <th>Plate Number</th>
                    <th>Brand</th>
                    <th>Fuel</th>
                    <th>Automatic</th>
                    <th>Year</th>
                    <th>Image</th>
                </tr>
            </thead>
            <?php
            $table =mysqli_query($conn,"SELECT  * from cars  where not exists ( select * from reservations
            where (cars.carsID = reservations.car_id )
            AND (reservations.starts_at<'".$until."') 
            AND (reservations.ends_at>'".$from."'))"); 
             ?> <form id="form" method="post"> <?php
            while ($row = mysqli_fetch_array($table)){?>
                        <tr style="cursor:pointer;" onclick="window.location='http:makeReservationUS.php?id=<?php echo $row ['plateNumber']?>&from=<?php echo $from ?>&until=<?php echo $until?>'">
                        <td><?php echo $row ['plateNumber']?></td>
                            <td><?php echo $row ['brand']?></td>
                            <td><?php echo $row ['fuel']?></td>
                            <td><?php if ( $row ['automatic'] ==="1"){ echo "<p>yes</p>";}else{echo "<p>no</p>";}?></td>
                            <td><?php echo $row ['year']?></td>
                            <td><?php echo'<img src= "'. $row ['img'].'">'?></td>
                            </a>
                        </tr>
            <?php } ?>
            </form>
        </table>
    </div>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
    <script>
        
        function submit() {
            let form = document.getElementById("form");
            form.submit();
        }
    </script>
</body>