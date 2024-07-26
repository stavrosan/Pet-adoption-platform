<?php
//

session_start();

if(!isset($_SESSION["user"]) && !isset($_SESSION["adm"])){
    header("Location: /home.php");
}

if(isset($_SESSION["user"])){//if it is a user it redirects to main page
    header("Location: /home.php");
}
//Connection with components to get access to database
require_once '../components/connect.php';

 

//We get the id to delete specific item
if(isset($_GET["id"]) && !empty($_GET["id"])){
   $id = $_GET["id"];
   $sql = "SELECT * FROM `animals` WHERE `id` = $id";
   $result = mysqli_query($connect,$sql);

   

   
   
   $row = mysqli_fetch_assoc($result);  // fetching the data 
    if($row["picture"] != "animal.jpg"){ // if the picture is not animal.jpg (the detault picture) we will delete the picture
    unlink("../assets/$row[picture]");
    }
    $sql = "DELETE FROM `animals` WHERE `id` = $id";
    mysqli_query($connect,$sql);

    if(mysqli_query($connect,$sql)){
        echo "
        <div class='alert alert-success' role='alert'>
         <h3 class='text-center'>Animal deleted!</h3>
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
   else{

   mysqli_close($connect);
   header("Location: adminpanel.php");
   }

