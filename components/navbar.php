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



echo "
<nav class='navbar navbar-expand-lg'>
  <div class='container-fluid'>
    <a class='navbar-brand' href='/home.php'><img src='https://cdn.pixabay.com/photo/2022/08/10/03/30/cat-7376274_640.png' style='height:60px; border-radius:10px;' alt='logo'></a>
    <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarNavAltMarkup' aria-controls='navbarNavAltMarkup' aria-expanded='false' aria-label='Toggle navigation'>
      <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNavAltMarkup'>
    <a class='navbar-brand active display-2 fw-bold' aria-current='page' href='/home.php'>Home</a>
    <a class='navbar-brand display-2 fw-bold' href='/senior.php'>Senior animals</a>
         <ul class='navbar-nav ms-auto mb-2 mb-lg-0'>
        ";
      
    if(isset($_SESSION["adm"])){
     echo "
     <li class='nav-item'>
     <a class='nav-link fw-bold' href='/animalCrud/create.php'>Create new entry</a>
     </li>
     <li class='nav-item'>
     <a class='nav-link fw-bold' href='/animalCrud/adminpanel.php'>Admin Panel</a>
     </li>
     <li class='nav-item'>
     <a class='nav-link fw-bold' href='/animalCrud/adminpanel.php'></a>
     </li>
     </ul>
     ";
   }
   if(isset($_SESSION["user"])) {
    echo "
   <li class='nav-item'>
   <img src='assets/{$userImage}' style='height:40px; border-radius:10px;' alt='user-avatar'>
   </li>
   <li class='nav-item'>
   <a class= 'nav-link text-white fw-bold' href='#'>Hello, {$userName}</a>
   </li>
   <li class='nav-item'>
   <a class= 'nav-link fw-bold' href='/user.php'>User details</a>
   </li>
   ";
  }
    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
     echo "
    <a class='nav-link fw-bold text-decoration-underline' href='/user/logout.php'>Logout</a>
    ";
  }
  else{
    echo "
    <a class='nav-link fw-bold text-decoration-underline' href='/user/register.php'>Register</a>
    <a class='nav-link fw-bold text-decoration-underline' href='/user/login.php'>Login</a>
    </div>
    </span>
    ";
  }
echo "
   </div>
  </div>
</nav>
";