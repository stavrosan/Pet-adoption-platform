<?php

session_start();

require_once 'components/connect.php';

if(isset($_SESSION["user"]) && isset($_POST["adopt"])){
$date = date("Y-m-d h:i:sa"); //H:i:s

//We insert in pet_adoption table userid, petid and date if the session is user and post from the form has the name adopt
$sqlInsert = "INSERT INTO `pet_adoption` (`fk_userid`, `fk_petid`, `adoption_date`) VALUES ($_SESSION[user], $_POST[animal], '$date')";
$sqlUpdate = "UPDATE `animals` SET `status`='Adopted' WHERE `id` = $_POST[animal]";
if(mysqli_query($connect, $sqlInsert) && mysqli_query($connect, $sqlUpdate)){
echo "
<div class='alert alert-success' role='alert'>
    <h3 class='text-center'>Animal adopted!</h3>
</div>
";
echo "<script>
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
echo "<script>
        setTimeout(function(){
        window.location.href = '/home.php';
        }, 2000); // Redirect after 2 seconds
     </script>";
}
}

$sql = "SELECT * FROM `animals` WHERE 1";
$result = mysqli_query($connect,$sql);
$cards = "";

if($rows = mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)) {
        $vaccin = ($row['vaccinated'] == 1) ? '<mark>Vaccinated</mark>' : 'Not vaccinated';//We define variable to convert boolean to a string

        $cards .= "
        <div class='col md-4 p-2'>
         <div class='card h-100'>
          <img src=../assets/$row[picture] class='card-img-top object-fit-cover' style='height:15rem' alt='animal_image'>
          <div class='card-body'>
          <h5 class='card-title title'> $row[name]</h5>
          <p class='card-text'>Breed: $row[breed]</p>
          <p class='card-text'>Age: $row[age]</p>
          <p class='card-text'>Size: $row[size]</p>
          <p class='card-text fst-italic text-decoration-underline'>$vaccin</p>
          <p class='card-text'>Status: $row[status]</p>
          <div class='d-flex justify-content-end'>
          <a href='animalCrud/details.php?id=$row[id]' class='btn details mx-2'>Show details</a> ";
          if(isset($_SESSION["user"]) && $row['status'] !== 'Adopted'){ //Take me home button only appears when status=available or not adopted
            $cards.="
            <form action='' method='POST'>
            <input type='hidden' name='animal' value='$row[id]'>
            <input type='submit' name='adopt' value='Take me home' class='adopt'>
            </form>
            "; 
        }
        $cards.="
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
 <h1 class="title text-center display-2 mt-4">Welcome to <span>PetPals </span> Adoption!</h1>
    <h4 class="text-center mb-5">
        At PetPals Adoption, our mission is to connect loving families with wonderful pets in need of a home!
    </h4>
 <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 row-cols-sm-1 row-cols-xs-1">
    <?= $cards ?>
 </div>
</div>

<?php require_once 'components/footer.php';?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>