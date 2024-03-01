<?php
session_start();
?>
<?php
    if($_SESSION['userAccess'] == ''){
        header("Location: index.php?error=noLogged");
        exit();
    }
    elseif($_SESSION["userAccess"]!=="admin"){
        header("Location: UserDashboardUS.php?error=noAdminPrivileges");
        exit();
    }
    require_once 'includes/selectCars.inc.php';
 ?>
<head>
    <title>Edit Car</title>
    <link rel="stylesheet" href="style.css?d=<?php echo time(); ?>">
</head>
<nav>
    <ul>
        <li><a href="adminPageAD.php" >Manage Users</a></li>
        <li><a href="createUserAD.php" >Create User</a></li>
        <li><a href="viewNoaccessAD.php">Manage NoAccess users</a></li>
        <li><a href="viewAllCarsAD.php">Manage Products</a></li>
        <li><a href="createCarAD.php" >Create Product</a></li>
        <li><a href="viewAllReservationsAD.php">View Reservations</a></li>
        <li><a href='includes/logout.inc.php'>log out</a></li>
    </ul>
</nav>
<body>
            <section>
                <div class="allforms" id ="registration-for">
<!--registration form -->
                    <?php foreach($Cars as $Cars){ ?>
                        <form action="includes/editCar.inc.php?id=<?php echo $Cars ['plateNumber']?>&img=<?php echo $Cars ['img']?>" method="post">
                    <h2>Edit Car with Plate Number: <?php echo htmlspecialchars($Cars['plateNumber'])?></h2> 
                        <div class="input container">
                        fuel<br>
                        <input type="radio" name="fuel" value="gasoline"  <?php if ( $Cars['fuel'] ==="gasoline"){?>  checked="checked"}<?php }?>>
                        <label for="gasoline">gasoline</label>
                        <input type="radio" name="fuel" value="oil"       <?php if ( $Cars['fuel'] ==="oil"){?>  checked="checked"}<?php }?>>
                        <label for="oil">oil</label><br>
                        </div>
                        <br>
                        <div class="input container">
                        year<br><input type="text" name="year"   value="<?php echo $Cars['year']?>"/>
                        </div>
                        <br>
                        <div class="input container">
                        brand<br><input type="text" name="brand"   value="<?php echo $Cars['brand']?>"/>
                        </div>
                        <br>
                        <div class="input container">
                        Image<br>(If EMPTY keeps : <?php echo $Cars['img']?> )<br><input type="file" id="avatar" name="image" accept="image/png, image/jpeg">
                        </div>
                        <br>
                        <div class="input container">
                        automatic<br>
                        <input type="radio" name="automatic" value="1"<?php if ( $Cars['automatic'] ==="1"){?>  checked="checked"}<?php }?>>
                        <label for="1">yes</label>
                        <input type="radio" name="automatic" value="0" checked="checked"<?php if ( $Cars['automatic'] ==="0"){?>  checked="checked"}<?php }?>>
                        <label for="0">no</label><br>
                        </div>
                        <br>
                        <button type="submit" name="update" >Update</button>
                        <br>
                        <button onclick="alertFunction()" type="delete" name="delete" id="deleteButton" >Delete</button>
                        <br>
                        
                    </form>
                    <?php } ?>
                </div>
<!--Error messages for each condition-->
                <?php
                    if (isset($_GET["error"])){
                        if($_GET["error"]=="emptyinput"){
                            echo "<p>Fill all the the fields</p>";
                        }
                        else if($_GET["error"]=="stmtfailed"){
                            echo "<p>Something went wrong try again</p>";
                        }
                        else if($_GET["error"]=="none"){
                            echo "<p>User Updated!</p>";
                        }
                    }
                 ?>
            </section>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
<script>
function alertFunction() {
  let text = "Confirm Deletion";
  if (confirm(text) == true) {
    text = "You pressed OK!";
  } else {
    event.preventDefault();
    text = "You canceled!";
  }
  document.getElementById("demo").innerHTML = text;
}
</script>
</body>