
<?php
include "_dbconnect.php";
include "../essential/_nav.php"; 
    if(isset($_POST['upload'])) {
        
        //Process the image that is uploaded by the user
    
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". basename($_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        // $image = $_FILES["image"];
        $id = $_SESSION['userid'];
        // $image=basename( $_FILES["image"]["name"],".jpg"); // used to store the filename in a variable
        // $imgContent = addslashes(file_get_contents($image));
        //storind the data in your database
        $sql= "UPDATE `signup` SET `image` = '$target_file' WHERE `user_id` = '$id'";
        $res = mysqli_query($conn,$sql);
        if($res){
            // header("location: /Login System/settings.php");
            echo("<script>location.href = '/Login System/settings.php';</script>");
        }
        // if($res){
        //     if(move_uploaded_file($_FILES['image']['tmp_name'], "$file")){
        //         echo "returned true  by uploaded file";
        //     }
        //     else{
        //         echo "returned false  by uploaded file";
        //     }
        // }
        // else{
        //     echo "Sorry, there was an error uploading your file.";
        // // }
    
        // require('heading.php');
        // echo "Your add has been submited, you will be redirected to your account page in 3 seconds....";
        // header( "Refresh:3; url=account.php", true, 303);
        
        // if(isset($_FILES['image'])){
        //     echo "true";
        //     echo $_FILES['image']['tmp_name'];
        // }

        // $file = $_FILES['image']['name'];

        // $sql = "UPDATE `signup` SET `Image` = $file WHERE `signup`.`user_id` = 1";
        // $res = mysqli_query($conn, $sql);

        

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

        echo '<div class="container">
        <form action="\Login System\upload\change_profile_picture.php" method="post" enctype="multipart/form-data">
            <h6>Upload New Image</h6>
            
            <div class="mb-3">
            <input type="file" name="image" id="imageUpload">
            <input type="submit" name="upload" value="UPLOAD"/>
            </div>
           
        </form>

    </div>';
    

    ?>