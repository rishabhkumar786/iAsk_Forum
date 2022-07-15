<?php
    include "_dbconnect.php";
    include "_nav.php";
    $user_id1 =  $_SESSION['userid'];
    $sql1 = "SELECT * FROM `request_box` WHERE `receiver_id` = $user_id";
    $result1 = mysqli_query($conn, $sql1);    
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Hello, world!</title>
    <script src="/Login System/javascript/contact.js"></script>
  </head>
  <body>
    <div class="container col-6">
        <h1>Pending Connection Requests</h1>
        <?php
            while($row = mysqli_fetch_assoc($result1)){
                $sender_id = $row['sender_id'];
                $sql2 =  "SELECT * FROM `signup` WHERE `user_id` = $sender_id";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $sender_name = $row2['username'];

                $receiver_id = $row['receiver_id'];
                
                echo '
                <div class="container overflow-hidden my-3">
                <div class="row gy-5">
                    <div class="col-2">
                        <img src="/Login System/essential/user.png" class="rounded mx-auto d-block" width="40px" alt="...">
                    </div>
    
                    <div class="col-6">
                        <div class="container row">
                            '. $sender_name .'
                        </div>
                        <div class="container row">
                            <div class="col-6">
                                <button  onclick="accept_req('.$sender_id.','.$receiver_id.')" type="button" class="btn btn-success mx-4 mt-2">Accept</button>
                            </div>
                            <div class="col-6">
                                <button  onclick="delete_req('.$sender_id.','.$receiver_id.')" type="button" class="btn btn-Danger mx-4 mt-2">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                ';
            }
        ?>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/Login System/javascript/contact.js"></script>
    <!-- <script src="/Login System/javascript/anwers.js"></script> -->
    
    
  </body>
</html>