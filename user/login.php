<?php

//user or admin redirects to home.php

session_start();



if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
    header("Location:/home.php");
    exit;
}

require_once '../components/connect.php';
require_once '../components/clean.php';
require_once '../components/navbar.php';

$emailError = "";
$passError = "";

if(isset($_POST["login"])){

    $email = clean($_POST["email"]);
    $pass = clean($_POST["pass"]);
    $error = false;

    if(empty($email)){
        $error = true;
        $emailError = "Enter email";
    
    }
    
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = true;
        $emailError = "Enter valid email";
    }

    if(empty($pass)){
        $error = true;
        $passError = "Enter password";
    
    }

    if(!$error){
        $pass = hash("sha256",$pass);

        $sql = "SELECT * FROM `users` WHERE email = '$email' AND pass = '$pass'";
        $result = mysqli_query($connect, $sql);
        

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if($row["status"] === "user"){
                $_SESSION["user"] = $row["id"];
                echo "
            <div class='alert' role='alert'>
                <h3 class='text-uppercase text-center fw-bold'>Welcome {$row["first_name"]}!</h3>
            </div>";
            echo "<script>
            setTimeout(function(){
                window.location.href = '/home.php';
            }, 2000); // Redirect after 2 seconds
          </script>";
            }
            elseif($row["status"] === "adm"){
                $_SESSION["adm"] = $row["id"];
                echo "
            <div class='alert' role='alert'>
                <h3 class='text-uppercase text-center fw-bold'>Welcome admin!</h3>
            </div>";
            echo "<script>
            setTimeout(function(){
                window.location.href = '/animalCrud/adminpanel.php';
            }, 2000); // Redirect after 2 seconds
          </script>";
            }
        }
        else{
            echo "
            <div class='alert alert-danger' role='alert'>
            <h3 class='text-center>Something went wrong!</h3>
            </div>";
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



<div class="container">
 <h3 class="all text-center mt-3">Login Page</h3>
        <form action="" method="POST" class="mx-auto form" style="max-width:700px; padding: 15px 35px 45px;">
           <div class="mb-3 mt-3">
               <input type="email" class="form-control" placeholder="email address" name="email" value="<?= $email??"";?>">
               <span><?= $emailError; ?></span>
            </div>
            <div class="mb-3 mt-3">
                <input type="password" class="form-control" placeholder="password" name="pass">
                <span><?= $passError; ?></span>
            </div>
            <input type="submit" value="Login" class=" login" name="login">
        </form>
        <p class="text-center m-4">Demo User  <strong>email: user1@user.com and password: 12345</strong></p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</body>
</html>