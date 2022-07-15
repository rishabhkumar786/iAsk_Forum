<?php include "essential/_dbconnect.php";
    include "essential/_nav.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo 'Profile of '. $_SESSION['username'].'' ?></title>
    <style>

    </style>
</head>

<body>
    
    <div class="container">
        <div class="row">
            <div class=" col-8">
                
                <div class="container mb-5">
                    <div class="container mt-2">
                        <div class="d-flex mx-5 mt-4">
                            <div class="flex-shrink-0">
                                    <img src="essential/user.png" title="1" width="150px" alt="...">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0" style="color: red; font-size: 20px; --darkreader-inline-color:#ff1a1a;" data-darkreader-inline-color=""><b> <?php echo $_SESSION['username']; ?> </b></p> 
                                <p> <?php echo $_SESSION['userid']; ?> </p> 
                                
                                <p> 
                                    <?php
                                        $user = $_SESSION['userid'];
                                        $sql1 = "SELECT * FROM followers_following WHERE user_id=$user";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row1 = mysqli_fetch_assoc($result1);

                                        $followers = $row1['followers'];
                                        $following = $row1['following'];
                                        $bio = $row1['bio'];

                                        echo 'Followers '. $followers .'&emsp;  Followings '. $following .'';
                                    
                                        echo '</p>           
                                        <p> 
                                        '. $bio .'
                                </p>';
                                ?>


                            </div>
                            
                            
                            
                        </div>
                        
                    </div>
                </div>

                <div class="container"> 

                <a href="" target="myframe"> Profile </a>  &emsp;
                <a href="Personal_answer_show.php?user_id=<?php echo $_SESSION['userid']?>" target="myframe"> Answer </a>   &emsp;
                <a href="personal_thread_show.php?user_id=<?php echo $_SESSION['userid']?>" target="myframe"> Questions </a> &emsp;
                <a href="" target="myframe"> Followers </a>&emsp;
                <a href="" target="myframe"> Following </a>&emsp;
                <br>
                <iframe width="500px" height="400px" name="myframe" class="my-3"></iframe>
                </div>


            </div>
        
            <div class=" col-4"><h1> TimeLine </h1> 

            <?php
            $xy = $_SESSION['userid'];
            $sql1 = "SELECT * FROM feeds WHERE Id = $xy";
            $result1 = mysqli_query($conn, $sql1);
            

            while($row1 = mysqli_fetch_assoc($result1)){
                $user_id = $row1['Id'];
                $title = $row1['title'];
                $content = $row1['content'];
                $likes = $row1['Likes'];
                $dislikes = $row1['Dislikes'];
                $Sno = $row1['Sno.'];

                $sql2 = "SELECT * FROM signup WHERE user_id = $user_id";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                
                $user_name =  $row2['username'];
                
                echo '                              
                    <div class="container mb-5">
                    <div class="container mt-2">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <a href="other_profile.php?target_id='. $user_id .'"><img src="essential/user.png" title="'. $user_id .'" width="40px" alt="..."></a>
                            </div>
                        </div>
                            <div class="flex-grow-1 ms-3">
                                
                                <p><b>'. $title .'</b></p>
                                <p>'. $content .' </p>      
                                <div class="row like">
                                    <p><button  onclick="likes('.$Sno.','.$likes.')" class="btn btn-primary ">Like</button> <span id="l'. $Sno .'"> ' . $likes .  '</span>
                                    <button  onclick="dislikes('.$Sno.','.$dislikes.')" class="btn btn-primary ">Dislike</button> <span id="d'. $Sno .'"> ' . $dislikes .  '</span>
                                    ';
                                    if($_SESSION['userid'] != $user_id){
                                        echo '<span id="s'. $Sno .'"><button  onclick="share_post('.$Sno.','.$_SESSION['userid'].')" class="btn btn-primary ">Share</button></span></p>'; 
                                    }

                                echo '
                                </div>                         
                            </div>
                        
                    </div>
                </div>';
            }
            ?>

            </div>

        </div>
        
    </div>


</body>

</html>