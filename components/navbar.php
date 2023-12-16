<?php


require 'connect.php';
require_once 'imageUpload.php';

if(isset($_SESSION["user"])){

$sql = "SELECT * FROM users WHERE id = {$_SESSION["user"]}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

$userName = $row["first_name"]. " " .$row["last_name"];
$userImage = $row["picture"];
};



echo"
<nav class='navbar navbar-expand-lg'>
  <div class='d-flex flex-row justify-content-between'>
  <div class='d-flex align-items-center'>
    <a class='navbar-brand fs-3 fw-bold' href='/home.php'>Adopt a pet</a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
      <div class='navbar-nav'>
        <a class='nav-link active' aria-current='page' href='/home.php'>Home</a>
        <a class='nav-link' href='/senior.php'>Seniors only</a>
        ";
    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        echo"
    <a class='nav-link' href='/user/logout.php'>Logout</a>
    ";
  }
  else{
    echo "
    <a class='nav-link' href='/user/register.php'>Register</a>
    <a class='nav-link' href='/user/login.php'>Login</a>
    ";
     }
     if(isset($_SESSION["adm"])){
        echo "
    <a class='nav-link' href='/animalCrud/create.php'>Create new entry</a>
    <a class='nav-link' href='/animalCrud/adminpanel.php'>Admin Panel</a>
    <a class='nav-link' href='/animalCrud/adminpanel.php'></a>
    
    ";
  }
  if(isset($_SESSION["user"])){
  echo "
  <div class='d-flex align-items-center justify-content-end'>
  <a class= 'nav-link text-white' href='/user.php'>User details</a>
  <a class= 'nav-link text-white' href='#'>Welcome {$userName}</a>
  <img src='assets/{$userImage}' style='height:30px' alt='user-avatar'>
  </div>
  ";}
echo "
      </div>
    </div>
  </div>
</nav>
";