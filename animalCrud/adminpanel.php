<?php

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: /home.php");
}

if(isset($_SESSION["user"])){//if it is a user it redirects to main page
    header("Location: /home.php");
}

require_once '../components/connect.php';

$sql = "SELECT * FROM `animals`";
$result = mysqli_query($connect,$sql);
$cards = "";

if($rows = mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {

        $vaccin = ($row['vaccinated'] == 1) ? 'Vaccinated' : 'Not vaccinated';//We define variable to convert boolean to a string

        $cards .= "
        <div class='col md-4 p-2'>
        <div class='card h-100'>
        <img src=../assets/$row[picture] class='card-img-top object-fit-cover' style='height:15rem' alt='animal_image'>
        <div class='card-body'>
          <h5 class='card-title'>Name: $row[name]</h5>
          <p class='card-text'>Breed: $row[breed]</p>
          <p class='card-text'>Age: $row[age]</p>
          <p class='card-text'>Size: $row[size]</p>
          <p class='card-text fst-italic'> $vaccin</p>
          <p class='card-text'>Status: $row[status]</p>
          <div class='mt-auto align-self-center'>
          <a href='details.php?id=$row[id]' class='btn details'>Show details</a>
          <a href='update.php?id=$row[id]' class='btn edit'>Edit</a>
          <a href='delete.php?id=$row[id]' class='btn delete'>Delete</a>
        </div>
      </div>
      </div>
      </div>
        ";
    }
}
else {
    $cards = "No data";
};

?>



<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>be20_cr5_StavrosAnagnostakis</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
    
    <?php require_once '../components/navbar.php';?>
    
    <div class="container">
    <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2">
    
       <?= $cards ?>

    </div>
    </div>
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    </body>
    </html>