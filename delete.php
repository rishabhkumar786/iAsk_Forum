<?php 
    include 'essential/_dbconnect.php';
    include 'essential/_nav.php';
    if(isset($_GET['threadid'])){
        $id = $_GET['threadid'];
        $sql = "DELETE FROM thread_list WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        if($result)
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else if(isset($_GET['thread_comm_id'])){
        $id2 = $_GET['thread_comm_id'];
        $sql = "DELETE FROM thread_discuss WHERE discuss_id=$id2";
        $result = mysqli_query($conn, $sql);
        if($result)
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

?>