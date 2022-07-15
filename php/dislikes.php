<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$sno= $_POST['type1'];
$userid= $_POST['type2'];
//echo '<script> console.log("in functions.php file") </script>';
    
if($regist == "success"){
    $dislikes++;
    
    $sql = "UPDATE `feeds` SET `Dislikes` = $dislikes WHERE `feeds`.`Sno.` = $sno";
    $result = mysqli_query($conn, $sql);
}
else if($regist == "share"){
    
    echo "in php file";
    
    $sql1 = "SELECT * FROM `feeds` WHERE `Sno.`=$sno";
    $result1 = mysqli_query($conn, $sql1);

    $row = mysqli_fetch_assoc($result1);

    $new_title = $row['title'];
    $new_content = $row['content'];

    $sql2 = "INSERT INTO `feeds` (`Id`, `title`, `content`) 
            VALUES ( '$userid', '$new_title', '$new_content')";
    // $sql2 = "INSERT INTO `feeds` (`Id`, `title`, `content`) VALUES (`$userid`, `$new_title`, `$new_content`)";
    $result2 = mysqli_query($conn, $sql2);

    if($result2){
        echo "Success";
    }
    else{
        echo "Not success";
        echo $userid;
    }
}
?>