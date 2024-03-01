<?php
session_start();
    require 'includes/dbh.inc.php';
    require_once 'includes/selectCars.inc.php';
    if($_SESSION['userAccess'] == ''){
        header("Location: index.php?error=noLogged");
        exit();
    }
    elseif($_SESSION['userAccess'] == 'admin'){
        header("Location:adminPageAD.php");
        exit();
    }  
    $from=$_GET["from"];
    $until=$_GET["until"];
 ?>
<head>
    <title>Reservation</title>
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
    <div id="containergeneral">
        <div id="main">
            <section>
                
            <table>
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
<!--registration form -->
                <?php
                     foreach($Cars as $Cars){?>
                        <tr style="cursor:default;">
                           <td><?php echo $Cars ['plateNumber']?></td>
                            <td><?php echo $Cars ['brand']?></td>
                            <td><?php echo $Cars ['fuel']?></td>
                            <td><?php if ( $Cars ['automatic'] ==="1"){ echo "<p>yes</p>";}else{echo "<p>no</p>";}?></td>
                            <td><?php echo $Cars ['year']?></td>
                            <td><?php echo'<img src= "'. $Cars ['img'].'">'?></td>
                        </tr>
                        </div>
                    
                    <?php } ?>
                    </table>
                    <div class="allforms" id ="registration-for">
                    <form action="includes/makeReservation.inc.php?id=<?php echo $Cars ['plateNumber']?>&carid=<?php echo $Cars ['carsID']?>&from=<?php echo $from ?>&until=<?php echo $until?>" method="post"> 
                    <h2>Reserve car with Plate Number: <?php echo htmlspecialchars($Cars['plateNumber'])?></h2>  
                    <button onclick="alertFunction()" type="submit" name="reserve" >RESERVE</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
<script>
    function alertFunction() {
  let text = "Confirm Reservation";
  if (confirm(text) == true) {
    text = "You pressed OK!";
  } else {
    event.preventDefault();
    text = "You canceled!";
  }
  document.getElementById("demo").innerHTML = text;
}
</script>
<footer>
    Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>