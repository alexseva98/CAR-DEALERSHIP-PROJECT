<?php
session_start();
?>
<?php
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
    <title>Register</title>
    <link rel="stylesheet" href="style.css?" >
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="icon" href="pictures/car.png"  type = "image/x-icon">

</head>
<nav>
    <ul>
        <li><a href="index.php">Home Page</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php" class="active">Register</a></li>
    </ul>
</nav>
<body>
    <div id="containergeneral">
        <div id="main">
            <section>
                <h2>Register</h2> 
                <div class="allforms" id ="registration-for">
<!--registration form-->
                    <form action="includes/register.inc.php" method="post">
                        <div class="input container">
                        First Name*<br><input type="text" name="fname" required  placeholder="First name..." />
                        </div>
                        <br>
                        <div class="input container">
                        Last name*<br><input type="text" name="lname" required   placeholder="Last name..." />
                        </div>
                        <br>
                        <div class="input container">
                        Country*<br><input id="country" list="all-countries" name="country" required  placeholder="Country..." />
                        <datalist id="all-countries">
                        
                        </datalist>
                        </div>
                        <br>
                        <div id="#cityDiv" class="input container" >
                        City*<br><input id="city" list="all-cities" name="city"  required  placeholder="City..." />
                        <datalist id="all-cities">
                        
                        </datalist>
                        </div>
                        <br>
                        <div class="input container">
                        E-mail*<br><input type="text" name="email" required  placeholder="E-mail..."/>
                        </div>
                        <br>
                        <div class="input container">
                        Username*<br><input type="text" name="uid" required  placeholder="Username..."/>
                        </div>
                        <br>
                        <div class="input container">
                        Password*<br><input type="password" name="pwd" required  placeholder="Password..." minlength="4"/>
                        </div>
                        <br>
                        <div class="input container">
                        Repeat password*<br><input type="password" name="pwdrepeat" required  placeholder="Repeat password..." minlength="4"/>
                        </div>
                        <br>
                        <button type="submit" name="submit" >Sign up</button>
                        <br>
                    </form>
                </div>
<!--Error messages for each condition-->
                <?php
                        if (isset($_GET["error"])){
                            if($_GET["error"]=="emptyinput"){
                                echo "<p>Fill all the the fields</p>";
                            }
                            else if($_GET["error"]=="invaliduid"){
                                echo "<p>Choose a proper username</p>";
                            }
                            else if($_GET["error"]=="invalidemail"){
                                echo "<p>Choose a proper email</p>";
                            }
                            else if($_GET["error"]=="passwordsdontmatch"){
                                echo "<p>Passwords dont match</p>";
                            }
                            else if($_GET["error"]=="stmtfailed"){
                                echo "<p>Something went wrong try again</p>";
                            }
                            else if($_GET["error"]=="usernametaken"){
                                echo "<p>Username or Email already taken</p>";
                            }
                            else if($_GET["error"]=="none"){
                                echo "<p>You have signed up</p>";
                            }
                        }
                ?>
                <div class="signup-image">
                    <a id = "redirect-image" href="login.php">I am already member</a>
                </div>
            </section>
        </div>
    </div>
<footer>
Copyright © 2022 - 2023 Team 9 - All Rights Reserved
</footer>
<script>
    $(document).ready(function() {
        $('#city').prop('disabled', true);
    $.get(
        'https://countriesnow.space/api/v0.1/countries/flag/images',
        function(res){
            console.log(res['data']);
            const countries = res['data'];
            $.each(countries,(c,cValue)=>{
                $("#all-countries").append("<option value='"+cValue['name']+"'>"+cValue['name']+"</option>")
            })
        }
    )

    $('#country').on('focusin',()=>{
        $('#city').prop('disabled', true);
        $('#city').val('');
    })

    $('#country').on('focusout',()=>{
        const data = {
            country: $('#country').val()
        }
        $.post(
        'https://countriesnow.space/api/v0.1/countries/cities',
        data,
        function(res){
            $("#all-cities").html("");
                console.log(res);
                if(!res['error']){
                    $('#city').prop('disabled', false);
                    const cities = res['data'];
                $.each(cities,(c,cityValue)=>{
                $("#all-cities").append("<option value='"+cityValue+"'>"+cityValue+"</option>")
            })
                }
            }
    )
    })

});
</script>
</body>