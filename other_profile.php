<?php
    include "essential/_dbconnect.php";
    include "essential/_nav.php";
    $id = $_GET['target_id'];
    
    $sql2 = "SELECT * FROM signup WHERE user_id=$id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $user_name = $row2['username'];
    $not_own = true;
    if($id == $_SESSION['userid']){
        header("location: profile.php");
    }
    $user_id= $_SESSION['userid'];
    $already_requested = false;
    $sql3 = "SELECT * FROM `request_box` WHERE `sender_id` = $user_id AND `receiver_id` = $id";
    $result3 = mysqli_query($conn, $sql3);
    $founded = mysqli_num_rows($result3);

    if($founded >= 1){
        $already_requested= true;
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title><?php echo "$user_name Profile";?></title>

</style>
</style>


  </head>
  <body>

  <div class="container">
        <div class="row">
            <div class=" col-8"> 
                
                <div class="container mb-5">
                    <div class="container mt-2">
                        <div class="d-flex mx-5 mt-4">
                            <div class="flex-shrink">
                                    <img src="essential/user.png" title="1" width="150px" alt="...">
                                    <?php
                                        if($already_requested == true){
                                        ?>
                                                <button name="<?php echo $_SESSION["userid"];?>" id="<?php echo $id;?>" type="button" class="btn btn-primary mx-4 mt-2 followbutton unfollow">Unfollow</button>
                                        <?php
                                        }
                                        else{
                                        ?>
                                                <button name="<?php echo $_SESSION["userid"];?>" id="<?php echo $id;?>" type="button" class="btn btn-success mx-4 mt-2 followbutton">+Follow</button>
                                        <?php
                                            $already_requested = true;
                                        }
                                    ?>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <p class="mb-0" style="color: red; font-size: 20px; --darkreader-inline-color:#ff1a1a;" data-darkreader-inline-color=""><b> <?php echo $user_name; ?> </b></p> 
                                <p> <?php echo $id ?> </p> 
                                
                                <p> 
                                    <?php
                                        $user = $id;
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
                <a href="" target="myframe"> Answer </a>   &emsp;
                <a href="personal_thread_show.php?user_id=<?php echo $id;?>" target="myframe"> Questions </a> &emsp;
                <a href="" target="myframe"> Followers </a>&emsp;
                <a href="" target="myframe"> Following </a>&emsp;
                <br>
                <iframe width="800px" height="400px" name="myframe" class="my-3"></iframe>
                </div>


            </div>
        
            <div class=" col-4"><h1> TimeLine </h1> 

            <?php
            $xy = $id;
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="javascript/anwers.js"></script>
</body>
</html>