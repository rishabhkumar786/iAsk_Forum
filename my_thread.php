<?php
    include "essential/_dbconnect.php";
    include "essential/_nav.php";
?>

<?php
            $xy = $_SESSION['userid'];
            // $sql1 = "SELECT * FROM thread_list WHERE thread_user_id = $xy";
            // $result1 = mysqli_query($conn, $sql1);
            
            $sql = "SELECT * FROM thread_list WHERE thread_user_id = $xy";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            $empty = false;

            while($row = mysqli_fetch_assoc($result)){
                $title = $row['thread_title'];
                $desc = $row['thread_description'];
                $user = $row['thread_user_id'];
                $id = $row['thread_id'];
                $upvote = $row['Upvote'];
                $downvote = $row['DownVote'];
                    
                    $sql4 = "SELECT * FROM signup WHERE user_id=$user";
                    $result4 = mysqli_query($conn, $sql4);
                    $row2 = mysqli_fetch_assoc($result4);
                    $user_name = $row2['username'];
                    $delete_comment = " ";
                   if(isset($_SESSION['userid']) && ($_SESSION['userid'] == $user)){
                        $delete_comment = "delete comment";
                   }
                        echo '<div class="container mb-5">
                                <div class="container mt-2">
                                <div class="d-flex mx-5 mt-4">
                                <div class="flex-shrink-0">
                                <a href="other_profile.php?target_id='. $user .'"><img src="essential/user.png" title="'. $user .'" width="40px" alt="..."></a>
                                
                                </div>
                                <div class="flex-grow-1 ms-3">
                                <p class="mb-0" style="color:red;font-size:20px;" ><b>' . $user_name . ' </b> &emsp;' . substr($row['timestamp'],0,10) . '&emsp; <a class="text-dark"  href="delete.php?threadid=' . $id . '">' . $delete_comment . '</a>
                                <h5 class="mt-2 mb-0 pt-0"><a class="text-dark" href="thread.php?threadid='. $id .'">' . $title . '</a></h5>' . $desc . '
                                <br/>
                                <div class="row like">
                                                        <p><button  onclick="upvote('.$id.','.$upvote.')" class="btn btn-primary ">Upvote</button> <span id="u'. $id .'"> ' . $upvote .  '</span>
                                                        <button  onclick="downvote('.$id.','.$downvote.')" class="btn btn-primary ">Downvote</button> <span id="dd'. $id .'"> ' . $downvote .  '</span></p>
                                </div>
                                
                                    
                                </div>
                            </div>
                                </div>
                                </div>
                ';
            }
            ?>