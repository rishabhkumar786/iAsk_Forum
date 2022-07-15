<?php
    
    $user_id =  $_SESSION['userid'];
    $sql = "SELECT * FROM `request_box` WHERE `receiver_id` = $user_id";
    $result = mysqli_query($conn, $sql);
    $GLOBALS['f'] = mysqli_num_rows($result); 
?>