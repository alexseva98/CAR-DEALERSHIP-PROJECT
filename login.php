<?php
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css?" >
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">
</head>
<nav>
    <ul>
        <li><a href="index.php">Home Page</a></li>
        <li><a href="login.php" class="active">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>
<body>   
    <div id="containergeneral">
        <div id="main">
            <section>
                <h2>Sign in</h2> 
                    <div class="allforms" id ="signin-for">
                        <!--Login Form-->
                        <form action="includes/login.inc.php" method="post">
                        E-mail<br><input type="text" name="uid"  placeholder="E-mail..." />
                        <br>
                        Password<br><input type="password" name="pwd" placeholder="Password..."/>
                        <br>
                        <button type="submit" name="submit" >Sign in</button>
                        <br>
                        </form>
                    </div>
                    <!--Error messages for each condition-->
                    <?php
                        if (isset($_GET["error"])){
                            if($_GET["error"]=="emptyinput"){
                                echo "<p>Fill all the the fields</p>";
                            }
                            else if($_GET["error"]=="wronglogin"){
                                echo "<p>Incorrect login information!</p>";
                            }
                            else if($_GET["error"]=="notactivated"){
                                echo "<p>Account not activated yet!</p>";
                                echo "<p>Pending Admins Approval</p>";
                            }
                        }
                    ?>
                    <div class="signin-image">
                    <a id = "redirect-image" href="register.php" class="signup-image-link">Dont have an account?</a>
                    </div>

            </section>
        </div>
    </div>
    <footer>
    Copyright © 2022 - 2023 Team 9 - All Rights Reserved
    </footer>
</body>


