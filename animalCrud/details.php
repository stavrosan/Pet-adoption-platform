<?php

session_start();


require_once '../components/connect.php';


//We connect the specific animal with it´s id

if(isset($_GET["id"]) && !empty($_GET["id"])){
  
    $sql = "SELECT * FROM `animals` WHERE `id` = $_GET[id]";
    $result = mysqli_query($connect,$sql);
    $detCards = "";
    
    if($rows = mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC); 
           $detCards .= "
          <div class='p-2'>
            <div class='card h-100' style='width:50rem';>
             <img src=../assets/{$row[0]["picture"]} class='card-img-top object-fit-cover background-center' style='height:40rem;' alt='animal_image'>
             <div class='card-body'>
              <h5 class='card-title'>Name: {$row[0]["name"]}</h5>
              <p class='card-text text-center'>Description: {$row[0]["description"]}</p>
              <p class='card-text text-center'>Breed: {$row[0]["breed"]}</p>
              <p class='card-text text-center'>Size: {$row[0]["size"]}</p>
              <p class='card-text text-center'>Age: {$row[0]["age"]}</p>
              <p class='card-text text-center'>Location: {$row[0]["location"]}</p>
            </div>
           </div>
          </div>
            ";
        
    }
    else {
        $detCards = "No data";
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
    
    
    
    <div class="containerDetails">
    
       <?= $detCards ?>
    
    </div>
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    </body>
    </html>