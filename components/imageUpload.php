<?php

//Function for uploading pictures from prework with assets the destination file and then display them all in home.php.
   function imageUpload($picture, $source = "user"){

     //If statement, if no picture has been chosen but we have set value Null in sql so not so important I guess.
        if($picture["error"] == 4){ 
           $pictureName = "avatar_user.png"; // the file name will be user_avatar.png (default picture for a user)
           if ($source == "animalCrud") {  // if the source is animalCrud 
            $pictureName = "animal.jpg";  //(default picture for an animal)
           }
           $message = "No picture has been chosen, but you can upload an image later :)";
       } else{
           $checkIfImage = getimagesize($picture["tmp_name"]); // checking if you selected an image, return false if you didn't select an image
           $message = $checkIfImage ? "Ok" : "Not an image";
       }

        if($message == "Ok"){
           $ext = strtolower(pathinfo($picture[ "name"],PATHINFO_EXTENSION)); 
           $pictureName = uniqid( ""). "." . $ext; 
           $destination = "../assets/{$pictureName}"; //the file will be saved in assets folder
           move_uploaded_file($picture["tmp_name"], $destination); 
       }

        return [$pictureName, $message]; 
   }

?>