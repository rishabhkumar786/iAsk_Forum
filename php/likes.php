<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$sno= $_POST['type1'];
$likes= $_POST['type2'];
//echo '<script> console.log("in functions.php file") </script>';
    
if($regist == "success"){
    $likes++;
    $sql = "UPDATE `feeds` SET `Likes` = $likes WHERE `feeds`.`Sno.` = $sno";
    $result = mysqli_query($conn, $sql);
}
?>