<?php



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Feeds</title>

</style>
</style>


  </head>
  <body>

        <?php
            include "essential/_dbconnect.php";
            include "essential/_nav.php";
            
            
        ?>

        
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h2 class= "text-center my-3"> Posts </h2>
                    <?php if(isset($_SESSION['userid'])){
                       echo '<a href="newpost.php" role="button"><button class="btn btn-primary">  New Post </button></a>';}
                       else{
                           echo '<div class="alert alert-danger" role="alert">Please Sign-In to Post Something</div>';
                       }
                   ?>
                    <?php
                        $sql1 = "SELECT * FROM feeds ORDER BY RAND ( ) LIMIT 30";
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
                                    <div class="d-flex mx-5 mt-4">
                                        <div class="flex-shrink-0">
                                            <a href="other_profile.php?target_id='. $user_id .'"><img src="essential/user.png" title="'. $user_id .'" width="40px" alt="..."></a>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0" style="color: red; font-size: 20px; --darkreader-inline-color:#ff1a1a;" data-darkreader-inline-color=""><b>'. $user_name .' </b></p> 
                                            <p><b>'. $title .'</b></p>
                                            <p>'. $content .' </p>      
                                            <div class="row like">
                                                <p><button  onclick="likes('.$Sno.','.$likes.')" class="btn btn-primary ">Like</button> <span id="l'. $Sno .'"> ' . $likes .  '</span>
                                                <button  onclick="dislikes('.$Sno.','.$dislikes.')" class="btn btn-primary ">Dislike</button> <span id="d'. $Sno .'"> ' . $dislikes .  '</span>
                                                ';
                                                if($_SESSION['userid'] != $user_id){
                                                    echo '<span id="s'. $Sno .'"><button  onclick="share_post('.$Sno.','.$_SESSION['userid'].')" class="btn btn-primary ">Share</button></span></p>'; 
                                                }

                                            echo '</div>                         
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    ?>
                    <!-- Required meta tags  '  <img src="essential/dislike.png" title="dislike" width="40px" alt="..."> ' . $dislikes .        <img role="button" src="essential/like.jpg" title="Like" width="40px" alt="..."> -->
                </div>
                <div class="col-4">
                    <h2 class= "text-center my-3"> Latest Threads </h2>
                    <?php
                        $sql3 = "SELECT * FROM thread_list ORDER BY RAND ( ) LIMIT 10";
                        $result3 = mysqli_query($conn, $sql3);
                        while($row3 = mysqli_fetch_assoc($result3)){
                            echo '<div class="container">
                                    <div class="flex-shrink-0">
                                        <img class="mx-3 my-3" src="essential/user.png" title="1" width="40px" alt="..."><a href="thread.php?threadid='. $row3['thread_id'] .'">'. mb_strimwidth($row3['thread_title'], 0, 30, "...") .'</a>
                                    </div>
                                  </div>';
                        }
                    ?>
                </div>
                
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="javascript/contact.js"></script>
  </body>
</html>