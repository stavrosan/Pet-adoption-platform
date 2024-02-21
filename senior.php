<?php

session_start();

require_once 'components/connect.php';

$sql = "SELECT * FROM `animals` WHERE `age` >= 8";
$result = mysqli_query($connect, $sql);
$cards = "";

if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $vaccin = ($row['vaccinated'] == 1) ? 'Vaccinated' : 'Not vaccinated';//We define variable to convert boolean to a string
            
            $cards .= "
                <div class='p-2'>
                 <div class='card h-100'>
                    <img src='../assets/$row[picture]' class='card-img-top object-fit-cover' style='height:15rem' alt='animal_image'>
                   <div class='card-body'>
                    <h5 class='card-title'>$row[name]</h5>
                    <p class='card-text'>Breed: $row[breed]</p>
                    <p class='card-text'>Age: $row[age]</p>
                    <p class='card-text'>Size: $row[size]</p>
                    <p class='card-text fst-italic text-decoration-underline'> $vaccin</p>
                    <p class='card-text'>Status: $row[status]</p>
                  </div>
                 </div>
                </div>
            ";
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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require_once 'components/navbar.php';?>


<div class="container">
<h1 class="all text-center display-2">Senior animals</h1>
<div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2">
    <?= $cards ?>
</div>
</div>

<?php require_once 'components/footer.php';?>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>