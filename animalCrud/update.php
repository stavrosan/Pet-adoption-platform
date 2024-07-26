<?php


session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: /home.php");
}

if(isset($_SESSION["user"])){//if it is a user it redirects to main page
    header("Location: /home.php");
}


require_once '../components/connect.php';
require_once '../components/imageUpload.php'; //we can update picture and send it to assets folder


//Select id to update specific item
    $sql = "SELECT * FROM `animals` WHERE `id` = $_GET[id]";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);

//Select which cols to update in the form in HTML
if(isset($_POST["update"])){
    $name = $_POST["name"];
    $picture = imageUpload($_FILES["picture"]);
    $breed = $_POST["breed"];
    $location = $_POST["location"];
    $description = $_POST["description"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $vaccinated = $_POST['vaccinated'] !=0 ? $_POST['vaccinated'] : 1;
    $status = $_POST['status'];
    
    
    if($_FILES["picture"]["error"] == 0){
        /* checking if the picture name of the animal is not animal.jpg to remove it from assets folder */
        if($row["picture"] != "animal.jpg"){
            unlink("../assets/$row[picture]");
        }
        $sql = "UPDATE `animals` SET `name`='$name',`picture`='$picture[0]',`breed`='$breed', `location`= '$location', `description`= '$description', `size`= '$size', `age`= '$age', `vaccinated`= '$vaccinated', `status`= '$status' WHERE `id` = $_GET[id] ";
    }
    else {
        $sql = "UPDATE `animals` SET `name`='$name', `breed`='$breed', `location`= '$location', `description`= '$description', `size`= '$size', `age`= '$age', `vaccinated`= '$vaccinated', `status`= '$status' WHERE `id` = $_GET[id] ";
    }
    
    
    if(mysqli_query($connect,$sql)){
        echo "
        <div class='alert alert-success' role='alert'>
         <h3 class='text-center'>Animal info updated!</h3>
        </div>
        ";
        echo "
        <script>
        setTimeout(function(){
        window.location.href = 'adminpanel.php';
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
         window.location.href = 'adminpanel.php';
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
<form action="" method="POST" enctype= "multipart/form-data" class="mx-auto mt-4 formCreateEdit" style="width:70%; padding: 15px 35px 45px;">
           <img src=../assets/<?=$row["picture"]?> class='d-block object-fit-contain rounded m-auto' style='width:10rem' alt='animal_image'>
           <h2 class="text-center">Edit info about <?= $row["name"] ?></h2>
           <div class="mb-3 mt-3">
               <label for="name" class= "form-label">Change name:</label>
               <input  type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Change photo:</label>
                <input type ="file" class="form-control" name="picture" value="<?= $row["picture"] ?>">
            </div>
            <div class="mb-3">
                <label for="breed" class="form-label">Change breed:</label>
                <input type="text" class="form-control" name="breed" value="<?= $row["breed"] ?>">
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Change location:</label>
                <input type="text" class="form-control" name="location" value="<?= $row["location"] ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Change description:</label>
                <input type="text" class="form-control" name="description" value="<?= $row["description"] ?>">
            </div>
            <div class="mb-3">
                <label for="size" class="form-label">Change size:</label>
                <input type="text" class="form-control" name="size" value="<?= $row["size"] ?>">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Change age:</label>
                <input type="number" class="form-control" name="age" value="<?= $row["age"] ?>">
            </div>
            <div class="mb-3">
            <label for="vacc" class="form-label">Vaccinated:</label>
            <select name="vaccinated" class="form-control">
                <option value="1" <?= ($row['vaccinated'] == 1) ? 'selected' : '' ?>>Yes</option>
                <option value="0" <?= ($row['vaccinated'] == 0) ? 'selected' : '' ?>>No</option>
            </select>
            </div>
            <div class="mb-3">
            <label for="status" class="form-label">Status:</label>
            <select name="status" class="form-control">
                <option value="0">Choose</option>
                <option <?= $row['status'] == "Available" ? "selected" : "" ?> value="Available">Available</option>
                <option <?= $row['status'] == "Adopted" ? "selected" : "" ?> value="Adopted">Adopted</option>
            </select>
            </div>
            <div class="mb-3">
            <button name="update" value="Update" type="submit" class="btn btn-warning">Update</button>
            <a href="/home.php" class="btn btn-secondary">Back to home page</a>
            </div>
        </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</body>
</html>