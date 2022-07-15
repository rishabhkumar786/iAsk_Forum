<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile of <?php echo $_SESSION['username'] ?></title>
    <style>

    </style>
</head>

<body>
    <?php include "essential/_dbconnect.php";
    include "essential/_nav.php";
    ?>
    <?php
    
    function fetch_image()
    {
        include "essential/_dbconnect.php";
        $id = $_SESSION['userid'];
        $sql = "SELECT * FROM signup WHERE user_id= $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['image'] != NULL) echo $row['image'];
        else  echo "uploads/user.png";
    }

    ?>

    <div class="container text-center">
        <p><img class="image-center" src="upload/<?php fetch_image()?>">

        <h4 class="container"> User name = <?php echo $_SESSION['username']; ?><br>
            User Id =<?php echo $_SESSION['userid']; ?><br>
            <br>
        </h4>

        </p>
         <a class="btn btn-warning" href="/Login System/upload/change_profile_picture.php" role="button">Change Profile Picture</a>
        <a class="btn btn-warning" href="edit.php" role="button">Edit</a>
    </div>

    <?php include "footer.php"; ?>

    <!--<form action="upload.php" method="post" enctype="multipart/form-data">
        <label>Select Image File:</label>
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>-->
</body>

</html>