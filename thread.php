<?php
//session_start();
//if (!isset($_SESSION['loggedin'])) {
//    header('location:login.php');
//}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Welcome!!</title>
</head>

<body>
    <?php

    include "essential/_nav.php";
    include "essential/_dbconnect.php";
    ?>
    <?php
    $id = $_GET['threadid'];
    $SQL = "SELECT * FROM thread_list WHERE thread_id=$id";
    $result = mysqli_query($conn, $SQL);
    $row = mysqli_fetch_assoc($result);
    ?>

    <?php
    $shooThis = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $thread_id = $_GET['threadid'];
        $discussion = $_POST['disc'];
        $discussion = str_replace("<", "&lt;", $discussion);
        $discussion = str_replace(">", "&gt;", $discussion);
        $userid = $_SESSION['userid'];
        $sql3 = "INSERT INTO `thread_discuss` (`thread_id`, `discussion`, `user_id`) VALUES ('$thread_id', '$discussion', '$userid')";

        $result3 = mysqli_query($conn, $sql3);
    }
    ?>

    <div class="container my-3 bg-dark text-white">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $row['thread_title']; ?></h1>
            <p class="lead"><?php echo $row['thread_description']; ?></p>


            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    <div class="container py-3">
        <h2>Start a Discussion</h2>
    </div>

    <?php
    if (isset($_SESSION['username'])) {
        echo '<div class="container">
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">
                    <h5 class="container">Answer this question</h5>
                </label>
                <textarea class="form-control" name="disc" id="exampleFormControlTextarea1" rows="1"></textarea>
                <button type="submit" class="btn btn-primary">Post</button>
            </div>
        </form>
            </div>';
    } else {
        echo ' <div class="container">
                 <h4>Not Logged in!!</h2>
                </div>';
    }

    ?>
    <div class="container text-center">
        <h2 class="my-4 mb-4">Comments</h2>
    </div>

    <?php
    $sql2 = "SELECT * FROM thread_discuss WHERE thread_id=$id";
    $result2 = mysqli_query($conn, $sql2);
    $num = mysqli_num_rows($result2);
    if ($num == 0) {
        echo '<div class=""container>
        <div class="alert alert-info mr-3" role="alert">
        Be The First one to answer this question!!
      </div>
        </div>';
    } else {
        while ($row = mysqli_fetch_assoc($result2)) {
            $id2 = $row['discuss_id'];
            $user_comment_id = $row['user_id'];
            $sql4 = "SELECT * FROM signup WHERE user_id=$user_comment_id";
            $result4 = mysqli_query($conn, $sql4);
            $row2 = mysqli_fetch_assoc($result4);
            $user_name = $row2['username'];
            $delete_comment = "";
            if(isset($_SESSION['userid'])&& ($_SESSION['userid'] == $user_comment_id)){
                $delete_comment = '<a href="delete.php?thread_comm_id='. $id2 .'">Delete comment</a>';
            }
            echo '<div class="container mb-5">
            <div class="d-flex mx-5">
            <div class="flex-shrink-0">
            <a href="other_profile.php?target_id='. $user_comment_id .'"><img src="essential/user.png" title="'. $user_comment_id .'" width="40px" alt="..."></a>
              
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="mb-0"><b>' . $user_name . ' </b> &emsp;' .  $row['timestamp'] . '  
            <h6 class="mb-2 pt-0">' . $row['discussion'] . '</h6>'. $delete_comment .'   
            </p>
            </div>
          </div>
            </div>';
        }
    }

    ?>




    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
    <?php
    include "footer2.php";
    ?>
</body>

</html>