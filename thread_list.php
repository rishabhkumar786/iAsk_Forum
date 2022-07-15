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
    <style>
        .container2{
            min-height: 100vh;
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="javascript/contact.js"></script>
</head>

<body>

    <?php include 'essential/_nav.php'; ?>
    <?php include 'essential/_dbconnect.php'; ?>
    
    <?php
    $show_alert = false;
    include "essential/_dbconnect.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $thread_title = $_POST['title'];
        $thread_title_desc = $_POST['title_desc'];
        $thread_title = str_replace("<", "&lt;", $thread_title);
        $thread_title = str_replace(">", "&gt;", $thread_title );
        $thread_title_desc = str_replace("<", "&lt;", $thread_title_desc);
        $thread_title_desc = str_replace(">", "&gt;", $thread_title_desc);
        $cat_id = $_GET['catid'];
        $user_id = $_SESSION['userid'];
        $user_sql = "INSERT INTO `thread_list` (`thread_title`, `thread_description`, `thread_user_id`, `thread_category_id`, `Privacy`) 
                    VALUES ('$thread_title', '$thread_title_desc', '$user_id', '$cat_id', 'Public')";
        $re = mysqli_query($conn, $user_sql);
        if ($re)
            $show_alert = true;
    }
    ?>
    
    
    
    
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM categories WHERE category_id = $id";
    $result_km = mysqli_query($conn, $sql);
    if(!$result_km)
    {
        echo "Not None!!" . $id;
        exit();
    }
    while ($row = mysqli_fetch_assoc($result_km)) {

        $catName = $row['category_name'];
        $catDesc = $row['category_description'];
    }

    ?>
    


    <div class="container2">
    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catName; ?></h1>
            <p class="lead"><?php echo $catDesc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <div class="container">
    <h2><b>Ask Something</b></h2>
    </div>
    <?php
    if (isset($_SESSION['username'])) {
        echo '<div class="container">
        <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <input class="form-control" type="text" name="title" placeholder="title" aria-label="Disabled input example">
        <input class="form-control" type="text" name="title_desc" placeholder="Brefly describe the title"
    aria-label="Disabled input example">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
        </div>';
    } else {
        echo ' <div class="container">
       <h4>Not Logged in!!</h2>
    </div>';
    }
    ?>




    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM thread_list WHERE thread_category_id = $id ORDER BY RAND ( ) LIMIT 30";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $empty = false;
    if ($num == 0) {
        $empty = true;
    }


    if ($show_alert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your Query has been posted!!
             </div>';
    }

    echo '<h1 class=" text-center mb-2"> Browse Questions</h1>';
    if ($empty) {
        echo '<div class="alert alert-info" role="alert">
        Be The First one to ask a question!!
      </div>';
    }
    while ($row = mysqli_fetch_assoc($result)) {
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
    </div>


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