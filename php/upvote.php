<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$id= $_POST['type1'];
$upvote= $_POST['type2'];
//echo '<script> console.log("in functions.php file") </script>';
    
if($regist == "success"){
    $upvote++;
    $sql = "UPDATE `thread_list` SET `Upvote` = $upvote WHERE `thread_list`.`thread_id` = $id";
    $result = mysqli_query($conn, $sql);
}
?>