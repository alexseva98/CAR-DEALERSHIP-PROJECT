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
    require_once 'includes/selectReservation.inc.php';
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
                    <?php foreach($Res as $Res){ ?>
                    <div class="allforms" id ="signin-for">
                    <form name="reservation" action="includes/editReservations.inc.php?id=<?php echo $Res ['id']?>" method="post">
                    <h2>Edit Reservation: <?php echo htmlspecialchars($Res['id'])?></h2> 
                    <div class="wrapper">
                        <div>
                            <label for="arrival">From</label>
                            <div class="field">
                                <input id="arrival" type="date" name="starts_at"  value="<?php echo $Res['starts_at']?>" min="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="gap"></div>
                        <div>
                            <label for="departure">Until</label> 
                            <div class="field">
                                <input id="departure" type="date" name="ends_at"  value="<?php echo $Res['ends_at']?>" min="<?php echo date("Y-m-d"); ?>">
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                        <br>
                        <button type="submit" name="update" >Update</button>
                        <br>
                        <button onclick="alertFunction()" type="delete" name="delete" >Delete</button>
                        <br>
                    </form>
                    </div>
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
  let text = "Press a button!\nEither OK or Cancel.";
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

<script>
document.forms['reservation'].onsubmit = function(event){
   
   if(this.starts_at.value > this.ends_at.value){
      document.querySelector(".error").innerHTML = "Please select valid dates";
      document.querySelector(".error").style.display = "block";
      event.preventDefault();
      return false;
   }
}
</script>