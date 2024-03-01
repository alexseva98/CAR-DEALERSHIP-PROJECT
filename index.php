<?php
require 'includes/dbh.inc.php';
session_start();
if(isset($_SESSION["useruid"])){
    if($_SESSION["userAccess"]==="admin"){
        header("Location: adminPageAD.php?error=allreadySigned");
        exit();
    }
    else{
    header("Location: UserDashboardUS.php?error=allreadySigned");
    exit();
    }   
}
?>
<head>
    <title>HOME PAGE</title>
    <link rel="stylesheet" href="style.css?" >
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">
</head>
<nav>
    <ul>
        <li><a href="index.php" class="active">Home Page</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>
<body>  
<?php
    if (isset($_GET["error"])){
        if($_GET["error"]=="loggedOut"){
            echo "<p>You ve logged out</p>";
        }
        if($_GET["error"]=="noAdminPrivileges"){
            echo "<p>Cant access Page due to Acces level</p>";
        }
        if($_GET["error"]=="noLogged"){
            echo "<p>You need to log in to acces the other pages</p>";
        }
    }
?>    
 <div class="container">
        <table class ="tableIndex">
        <h2>ALL CARS</h2>
        <form name="reservation" method="post" action="searchResaultIndex.php">
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
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
</body>
