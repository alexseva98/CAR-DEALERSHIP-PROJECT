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
    <title>Create Car</title>
    <link rel="stylesheet" href="style.css?" >
</head>
<nav>
    <ul>
        <li><a href="adminPageAD.php" >Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php">Manage Products</a></li>
        <li><a href="createCarAD.php" class="active">Create Product</a></li>
        <li><a href="viewAllReservationsAD.php">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<body>

        <div id="main">
            <section>
                <h2>Create Car</h2> 
                
<!--registration form-->
                    <form action="includes/createCar.inc.php" method="post">
                        <div class="input container">
                        plateNumber*<br><input type="text" name="plateNumber" required  placeholder="plateNumber..." />
                        </div>
                        <br>
                        <div class="input container">
                        fuel*<br>
                        <input type="radio" name="fuel" value="gasoline"  checked="checked" required>
                        <label for="gasoline">gasoline</label>
                        <input type="radio" name="fuel" value="oil">
                        <label for="oil">oil</label><br>
                        </div>
                        <br>
                        <div class="input container">
                        year*<br><input type="text" name="year" required  placeholder="year..." />
                        </div>
                        <br>
                        <div class="input container">
                        brand*<br><input type="text" name="brand" required  placeholder="brand..." />
                        </div>
                        <br>
                       
                      
                        <div class="input container">
                        Image<br>(If EMPTY gets a default picture)<br><input type="file" id="avatar" name="image" accept="image/png, image/jpeg">
                        </div>
                        <br>
                        <div class="input container">
                        automatic*<br>
                        <input type="radio" name="automatic" value="1" required>
                        <label for="1">yes</label>
                        <input type="radio" name="automatic" value="0" checked="checked">
                        <label for="0">no</label><br>
                        </div>
                        <br>
                        <button type="submit" name="submit" >Create</button>
                        <br>
                    </form>
                
<!--Error messages for each condition-->
                <?php
                        if (isset($_GET["error"])){
                            if($_GET["error"]=="emptyinput"){
                                echo "<p>Fill all the the fields</p>";
                            }
                            if($_GET["error"]=="invalidplate"){
                                echo "<p>Plate number allready exists</p>";
                            }
                        }
                ?>
            </section>
        </div>

<footer>
Copyright © 2022 - 2023 Team 11- All Rights Reserved
</footer>
</body>