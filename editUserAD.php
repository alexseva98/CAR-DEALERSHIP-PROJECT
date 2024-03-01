<?php
session_start();
?>
<?php
    if($_SESSION['userAccess'] == ''){
        header("Location: index.php?error=noAdminPrivileges");
        exit();
    }
    elseif($_SESSION["userAccess"]!=="admin"){
        header("Location: UserDashboardUS.php?error=noAdminPrivileges");
        exit();
    }
    require_once 'includes/selectUser.inc.php';
 ?>
<head>
    <title>Edit User</title>
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
                    <?php foreach($Users as $Users){ ?>
                    <form action="includes/editUser.inc.php?id=<?php echo $Users ['usersUid']?>" method="post">
                    <h2>Edit User: <?php echo htmlspecialchars($Users['usersUid'])?> / <?php echo htmlspecialchars($Users['usersEmail'])?></h2> 
                        <div class="input container">
                        First Name<br><input type="text" name="fname"  value="<?php echo $Users['usersFname']?>" />
                        </div>
                        <br>
                        <div class="input container">
                        Last name<br><input type="text" name="lname"  value="<?php echo $Users['usersLname']?>"/>
                        </div>
                        <br>
                        <div class="input container">
                        Country<br><input type="text" name="country"   value="<?php echo $Users['usersCountry']?>"/>
                        </div>
                        <br>
                        <div class="input container">
                        City<br><input type="text" name="city"   value="<?php echo $Users['usersCity']?>"/>
                        </div>
                        <br>
                        <div class="input container">
                        Role<br>
                        <input type="radio" name="usersAccess"  required id="radio" onclick="radioHandler()" value="admin" <?php if ( $Users['usersAccess'] ==="admin"){?>  checked="checked"}<?php }?>>
                        <label for="admin">admin</label>
                        <input type="radio" name="usersAccess" id="radio"  onclick="radioHandler()" value="user" <?php if ( $Users['usersAccess'] ==="user"){?>  checked="checked"}<?php }?>>
                        <label for="user">user</label><br>
                        </div>
                        <br>
                        <button id ="updateBtn" type="submit" name="update">Update</button>
                        <br>
                        <button onclick="alertFunction()" type="delete" name="delete" >Delete</button>
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