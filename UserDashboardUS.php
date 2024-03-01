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
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">
</head>
<nav>
<ul>
    <li><a href="UserDashboardUS.php" class="active">Home Page</a></li>
    <li><a href="viewYourReservationsUS.php">My Reservations</a></li>
    <li><a href='viewYourInfoUS.php'>My Information</a></li>
    <li><a href='includes/logout.inc.php'>log out</a></li>
</ul> 
</nav>
<body>
    <?php
    if (isset($_GET["logeduser"])){
        if($_GET["logeduser"]=="yes"){
            echo'<p>Welcome '. $_SESSION["useruid"] . '</p>' ;
            }
        }
    ?>
    <div class="container">
        <table class ="tableIndex">
        <h2>ALL CARS</h2>
        <form name="reservation" method="post" action="searchResaultUS.php">
                    <div class="wrapper">
                        <div>
                            <label for="arrival">From</label>
                            <div class="field">
                                <input id="arrival" type="date" name="starts_at" value="<?php echo date("Y-m-d"); ?>" required min="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="gap"></div>
                        <div>
                            <label for="departure">Until</label> 
                            <div class="field">
                                <input id="departure" type="date" name="ends_at" required min="<?php echo date("Y-m-d"); ?>">
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                <button type="submit" name="query" >SEARCH</button>
        </form>
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
            $table = mysqli_query($conn,'SELECT * FROM cars');
            while ($row = mysqli_fetch_array($table)){?>
                        <tr style="cursor:default;">
                            <td><?php echo $row ['plateNumber']?></td>
                            <td><?php echo $row ['brand']?></td>
                            <td><?php echo $row ['fuel']?></td>
                            <td><?php if ( $row ['automatic'] ==="1"){ echo "<p>yes</p>";}else{echo "<p>no</p>";}?></td>
                            <td><?php echo $row ['year']?></td>
                            <td><?php echo'<img src= "'. $row ['img'].'">'?></td>
                        </tr>
                        </div>
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
<script>
    //Date values check
    document.forms['reservation'].onsubmit = function(event)
    {
        if(this.starts_at.value > this.ends_at.value){
            document.querySelector(".error").innerHTML = "Please select valid dates";
            document.querySelector(".error").style.display = "block";
            event.preventDefault();
            return false;
        }
    }
</script>
</body>