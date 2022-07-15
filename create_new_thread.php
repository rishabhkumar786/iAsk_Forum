<?php
    include 'essential/_dbconnect.php';
  include 'essential/_nav.php';
?>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $thread_title = $_POST['title'];
        $thread_title_desc = $_POST['title_desc'];
        $thread_title = str_replace("<", "&lt;", $thread_title);
        $thread_title = str_replace(">", "&gt;", $thread_title );
        $thread_title_desc = str_replace("<", "&lt;", $thread_title_desc);
        $thread_title_desc = str_replace(">", "&gt;", $thread_title_desc);
        
        $user_id = $_SESSION['userid'];
        $user_sql = "INSERT INTO `categories` (`category_name`, `category_description`) 
                    VALUES ( '$thread_title', '$thread_title_desc')";
        $re = mysqli_query($conn, $user_sql);
        if ($re){
            echo '<div class="alert alert-success" role="alert">Category has been Posted</div>';
            // header("location: ?sessionPassed=true");
            header( "refresh:1;url=index.php" );
        }
    }
?>




<?php

    

    echo '
            <button type="button" class="btn btn-dark my-3 top-0 start-50 position-relative">
            New Thread <svg width="1em" height="1em" viewBox="0 0 16 16" class="position-absolute top-100 start-50 translate-middle mt-1 bi bi-caret-down-fill" fill="#212529" xmlns="http://www.w3.org/2000/svg"><path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/></svg>
        </button>
    <div class="container">
            <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                <input class="form-control" type="text" name="title" placeholder="Thread name" aria-label="Disabled input example">
                <input class="form-control" type="text" name="title_desc" placeholder="Thread Description"aria-label="Disabled input example">
                <button type="submit" class="btn btn-primary">Submit</button>
             </form>
          </div>';
?>