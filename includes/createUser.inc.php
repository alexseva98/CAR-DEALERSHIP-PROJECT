<?php
if(isset($_POST["submit"])){

    $fname=$_POST["fname"];
    $lname=$_POST["lname"];
    $country=$_POST["country"];
    $city=$_POST["city"];
    $email=$_POST["email"];
    $username=$_POST["uid"];
    $pwd=$_POST["pwd"];
    $pwdRepeat=$_POST["pwdrepeat"];
    $access=$_POST["usersAccess"];
    
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($fname, $lname, $country, $city, $email, $username, $pwd, $pwdRepeat) !==false){
        header("Location: ../createUserAD.php?error=emptyinput");
        exit();

    }if(invalidUid($username) !==false){
        header("Location: ../createUserAD.php?error=invaliduid");
        exit();

}
    if(invalidEmail($email) !==false){
        header("Location: ../createUserAD.php?error=invalidemail");
        exit();

}
    if(pwdMatch($pwd,$pwdRepeat) !==false){
        header("Location: ../createUserAD.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $username, $email) !==false){
        header("Location: ../createUserAD.php?error=usernametaken");
        exit();
    }
    adminCreateUser($conn, $fname, $lname, $country, $city, $email, $username, $pwd, $access);
}
else {
    header("Location: ../register.php");
    exit();
}

