<?php


require_once 'connect.php';
require_once 'imageUpload.php';




echo "
<nav class='navbar navbar-expand bg-dark'>
<div class='container-fluid align-center'>
<ul class='navbar-nav'>
    <li class='nav-item'>
    <a class='navbar-brand text-warning fs-2 fst-italic' href='/home.php'>Adopt a pet</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand active text-white display-2' aria-current='page' href='/home.php'>Home</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/senior.php'>Seniors only</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='#'>About us</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='#'>Donate</a>
    </li>
   ";
    if(isset($_SESSION["user"]) || isset($_SESSION["adm"])){
        echo"
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/animalCrud/adminpanel.php'>Admin Panel</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/user/logout.php'>Logout</a>
    </li>
    ";
  }
  else{
    echo "
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/user/register.php'>Register</a>
    </li>
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/user/login.php'>Login</a>
    </li>
    ";
     }
     if(isset($_SESSION["adm"])){
        echo "
    <li class='nav-item'>
    <a class='navbar-brand text-white display-2' href='/animalCrud/create.php'>Create new entry</a>
    </li>
    </ul>
    ";}
    /*if(isset($_SESSION["user"])){
    echo "
    <a class='navbar-brand' href='#'>
                <img src='assets/$row[picture]' alt='user_logo' width='30' height='24'>
            </a>";
        }*/
echo "
</div>
</nav>
";