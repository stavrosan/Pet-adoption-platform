<?php

session_start();

    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        header("Location: /home.php");
        exit; //for protection
    }

require_once '../components/connect.php';
require_once '../components/clean.php';
require_once '../components/imageUpload.php';

$emailError = "";
$passError = "";

if(isset($_POST["register"])){

    $email = clean($_POST["email"]);
    $pass = clean($_POST["pass"]);
    $picture = imageUpload($_FILES["picture"],"user");
    $first_name = clean($_POST["fname"]);
    $last_name = clean($_POST["lname"]);
    $address = clean($_POST["address"]);
    $phone = clean($_POST["phone"]);
    $error = false;


if(empty($email)){
    $error = true;
    $emailError = "Enter email";

}

elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $error = true;
    $emailError = "Enter valid email";
}

else{
    $sql =  "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($connect,$sql);
    if(mysqli_num_rows($result)!== 0){
        $error = true;
        $emailError = "email already exists";
    }
}

if(empty($pass)){
    $error = true;
    $passError = "Enter password";

}

elseif(strlen($pass) < 4){
    $error = true;
    $passError = "Password must be at least 4 characters long";
}

if($error === false){
    $pass = hash("sha256",$pass); //algorithm for password for security

    $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `phone_number`, `address`, `picture`, `pass`) VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$picture[0]', '$pass')";
    $result = mysqli_query($connect, $sql);

    if($result){
        echo "
        <div class='alert alert-success text-center' role='alert'>
            New user created!
        </div>
        ";
    
        }
        else {
        echo "   
        <div class='alert alert-danger text-center' role='alert'>
             Error!
        </div>
       " ;
    }

    }

}
mysqli_close($connect);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php require_once '../components/navbar.php';?>

<div class="container">
<h3 class="all text-center mx-auto mt-3">Register Form</h3>
<form action="" method="POST" enctype= "multipart/form-data" class="mx-auto form" style="max-width:600px; padding: 15px 35px 45px;">
           <div class="mb-3 mt-3">
               <label for="fname" class= "form-label">First Name:</label>
               <input  type="text" class="form-control" name="fname">
            </div>
            <div class="mb-3 mt-3">
               <label for="lname" class= "form-label">Last Name:</label>
               <input type="text" class="form-control" name="lname">
            </div>
            <div class="mb-3 mt-3">
               <label class="form-label">Email:</label>
               <input  type="email" class="form-control" name="email" value="<?= $email??"";?>">
               <span><?= $emailError; ?></span>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Tel:</label>
                <input type="number" class="form-control" name="phone">
            </div>
            <div class="mb-3">
               <label for="address" class= "form-label">Address:</label>
               <input  type="text" class="form-control" name="address">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Photo:</label>
                <input type = "file" class="form-control" name="picture">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="password" class="form-control"  name="pass">
                <span><?= $passError; ?></span>
                </div>
                <div>
            <input type="submit" value="Register" class="register" name="register">
            </div>
            
        </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</body>
</html>