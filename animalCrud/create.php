<?php
session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: /home.php");
}

if(isset($_SESSION["user"])){//if it is a user it redirects to main page
    header("Location: /home.php");
}
require_once '../components/connect.php';
require_once '../components/imageUpload.php';

//Select the cols from database table to create a new entry from the form in HTML
if(isset($_POST["create"])){
    $name = $_POST["name"];
    $picture = imageUpload($_FILES["picture"],"animalCrud");
    $breed = $_POST["breed"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    

    $sql = "INSERT INTO `animals`( `name`, `picture`, `breed`, `location`, `description`, `size`, `age`) VALUES ('$name','$picture[0]','$breed','$location','$description','$size','$age')";

    if(mysqli_query($connect,$sql)){
        echo "
        <div class='alert alert-light' role='alert'>
        <h3 class='text-success'>New entry created!</h3>
        </div>
        ";
        echo "
        <script>
        setTimeout(function(){
        window.location.href = '/home.php';
        }, 2000); // Redirect after 2 seconds
        </script>";
    
        }
        else {
        echo "   
        <div class='alert alert-danger' role='alert'>
             Error!
        </div>
       " ;
       echo "
        <script>
        setTimeout(function(){
        window.location.href = '/home.php';
        }, 2000); // Redirect after 2 seconds
        </script>";
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
<form action="" method="POST" enctype= "multipart/form-data" class="mx-auto mt-4 formCreateEdit" style="width:60%; padding: 15px 35px 45px;">
           <h3 class="text-center">Create</h3>
           <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Name:</label>
               <input  type="text" class="form-control" name="name">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Photo:</label>
                <input type ="file" class="form-control" name="picture">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Breed:</label>
                <input type="text" class="form-control" name="breed">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location:</label>
                <input type="text" class="form-control" name="location">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control" name="description">
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Size:</label>
                <input type="text" class="form-control" name="size">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age:</label>
                <input type="number" class="form-control" name="age">
            </div>
            <div class="mb-3">
            <button name="create" value="Create" type="submit" class="btn btn-primary">Create entry</button>
            <a href="/home.php" class="btn btn-warning">Back to home page</a>
            </div>
        </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</body>
</html>