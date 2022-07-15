<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$id= $_POST['type1'];
$downvote= $_POST['type2'];
//echo '<script> console.log("in functions.php file") </script>';
    
if($regist == "success"){
    $downvote--;
    
    $sql = "UPDATE `thread_list` SET `DownVote` = $downvote WHERE `thread_list`.`thread_id` = $id";
    $result = mysqli_query($conn, $sql);
}
?>