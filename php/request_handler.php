<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$sender_id= $_POST['type1'];
$receiver_id= $_POST['type2'];
//  echo '<script> console.log("in requesthandle.php file") </script>';
    
if($regist == "acc"){
    //get followers of receiver and following of sender
    $sql1 = "SELECT * FROM `followers_following` WHERE `user_id`=$sender_id";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $sender_following = $row1['following'];

    $sql2 = "SELECT * FROM `followers_following` WHERE `user_id`=$receiver_id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $receiver_followers = $row2['followers'];

    $sender_following++;
    $receiver_followers++;

    $sql3 = "UPDATE `followers_following` SET `followers`= $receiver_followers WHERE `user_id`=$receiver_id";
    $result3 = mysqli_query($conn, $sql3);

    $sql4 = "UPDATE `followers_following` SET `following`= $sender_following WHERE `user_id`=$sender_id";
    $result4 = mysqli_query($conn, $sql4);

    
    $sql5="DELETE FROM `request_box` WHERE `sender_id` = $sender_id AND `receiver_id`=$receiver_id";
    $result5=mysqli_query($conn, $sql5);
}
else if($regist == "dle"){
    $sql6="DELETE FROM `request_box` WHERE `sender_id` = $sender_id AND `receiver_id`=$receiver_id";
    $result6=mysqli_query($conn, $sql6);
}
?>