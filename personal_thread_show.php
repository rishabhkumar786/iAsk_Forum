<?php include "essential/_dbconnect.php";
    
?>

<?php
    $id = $_GET['user_id'];
    //$username = $_GET['username'];
    $sql1 = "SELECT * FROM thread_list WHERE thread_user_id=$id";
    $result1 = mysqli_query($conn, $sql1);
    
    $sql2 = "SELECT * FROM signup WHERE user_id=$id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $user_name = $row2['username'];
    while($row1 = mysqli_fetch_assoc($result1)){
        $thread_title = $row1['thread_title'];
        $thread_desc = $row1['thread_description'];
        
        
        echo '
        <div class="container mb-5">
        <div class="d-flex mx-5">
        <div class="flex-shrink-0">
          <img src="essential/user.png" title="" width="40px alt="...">
        </div>
        <div class="flex-grow-1 ms-3">
        <p class="mb-0" style="color:red;font-size:20px;" ><b>' . $user_name . ' </b> &emsp;' . substr($row1['timestamp'],0,10) . '
        <h5 class="mt-2 mb-0 pt-0"><a class="text-dark" href="thread.php?threadid='. $id .'">' . $thread_title . '</a></h5>' . $thread_desc . '
        </div>
      </div>
        </div>
        ';
    }
?>