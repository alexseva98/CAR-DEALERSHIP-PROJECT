<?php
//functions for sign up(register)

//function that checks if there are any empty input fields           input fields           input fields           input fields           input fields           input fields           input fields           input fields
function emptyInputSignup($fname, $lname, $country, $city, $email, $username, $pwd, $pwdRepeat){
    $result;
    if ( empty($fname) || empty($lname) || empty($country) || empty($city) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat) ){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//function that checks the validity of the username        validity of the username        validity of the username        validity of the username        validity of the username        validity of the username
function invalidUid($username){
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result= true;
    }
    else{
        $result=false;
    }
    return $result;
}
//function that checks if the email is in email format         email is in email format         email is in email format         email is in email format         email is in email format         email is in email format 
function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result= true;
    }
    else{
        $result=false;
    }
    return $result;
}
//checking if password is the same with the repeated password               password is the same with the repeated password           password is the same with the repeated password
function pwdMatch($pwd, $pwdRepeat){
    $result;
    if ($pwd !== $pwdRepeat){
        $result= true;
    }
    else{
        $result=false;
    }
    return $result;
}
//function for login and register
//function that checks if the username and email are in db        username and email are in db        username and email are in db         username and email are in db         username and email are in db  
function uidExists($conn, $username, $email){
    $sql="SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$username, $email);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
//function that register users info in the table users       users info in the table users       users info in the table users       users info in the table users       users info in the table users
function createUser($conn,$fname, $lname, $country, $city, $email, $username, $pwd, $access){
    $sql="INSERT INTO users(usersFname, usersLname, usersCountry, usersCity, usersEmail, usersUid, usersPassword, usersAccess) VALUES(?, ?, ?, ?, ?, ?, ?,?) ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);  //hashing users password
    mysqli_stmt_bind_param($stmt,"ssssssss",$fname, $lname, $country, $city, $email, $username, $hashedPwd, $access);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../register.php?error=none");
    exit();
}
//function that checks for empty input fields
function emptyInputlogin($username, $pwd){
    $result;
    if ( empty($username) || empty($pwd) ){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
//function that logs the user in the system via sessions        logs the user        logs the user        logs the user        logs the user        logs the user        logs the user        logs the user
function loginUser($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

    if($uidExists === false){
        header("Location: ../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $uidExists["usersPassword"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    if ($checkPwd === false) {
        header("Location: ../login.php?error=wronglogin");
    }
    else if($checkPwd === true) {
        //checking if account is activated
        if  ($uidExists["usersAccess"]==="noAccess"){
            header("Location: ../login.php?error=notactivated");
            exit();
        }
        session_start();
        $_SESSION["userid"]=$uidExists["usersID"];
        $_SESSION["useruid"]=$uidExists["usersUid"];
        $_SESSION["userAccess"]=$uidExists["usersAccess"];
        $_SESSION["usersEmail"]=$uidExists["usersEmail"];
        if ($_SESSION["userAccess"]==="admin"){
            header("Location:../adminPageAD.php?logeduser=yes");
            exit();
        }
        else{
        header("Location: ../UserDashboardUS.php?logeduser=yes");
        exit();
        }
    }
}
//ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN         ADMIN                

//function that REGISTERS    users info in the database,in the table users BY THE ADMIN
function adminCreateUser($conn,$fname, $lname, $country, $city, $email, $username, $pwd, $access){
    $sql="INSERT INTO users(usersFname, usersLname, usersCountry, usersCity, usersEmail, usersUid, usersPassword, usersAccess) VALUES(?, ?, ?, ?, ?, ?, ?,?) ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../createUserAD.php?error=stmtfailed");
        exit();
    }
   
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);  //hashing users password
    mysqli_stmt_bind_param($stmt,"ssssssss",$fname, $lname, $country, $city, $email, $username, $hashedPwd, $access);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../adminPageAD.php?error=userCreated");
    exit();
}

//function that REGISTERS   cars in the database,in the table cars BY THE ADMIN
function adminCreateCar($conn,$plateNumber, $fuel, $year, $brand, $automatic, $img){
    $sql="INSERT INTO cars(plateNumber, fuel, year, brand, automatic, img) VALUES(?, ?, ?, ?, ?, ?) ;";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ssssss",$plateNumber, $fuel, $year, $brand, $automatic, $img);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../viewAllCarsAD.php?crtd=$plateNumber");
    exit();
}

//function that checks if platenumber allready in db
function plateExists($conn, $plateNumber){
    $sql="SELECT * FROM cars WHERE plateNumber = ? ";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../register.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$plateNumber);
    mysqli_stmt_execute($stmt);
    $resultData=mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result=false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}


