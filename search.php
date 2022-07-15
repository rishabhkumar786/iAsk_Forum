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
        .container123 {
            min-height: 100vh;
        }
    </style>
</head>

<body class="container123">

    
    <?php 
     include 'essential/_nav.php';
     include 'essential/_dbconnect.php';
        function search(){
            echo $_GET['search'];
        }
    ?>



    <div class="search container">
            <h1>Search Result For <em> "<?php search()?>"</em> </h1>
            <?php 
                        $noresult = true;
                        $qye = $_GET['search'];
                        $sql = "SELECT * FROM thread_list WHERE CONCAT(thread_title, thread_description) LIKE '%$qye%'";
                        //$sql = "SELECT * FROM thread_list WHERE match (thread_id, thread_title, thread_description) against ('$qye')";
                        $run = mysqli_query($conn, $sql);
                        if(!$run)
                            die("query not runned!!");
                        while($row = mysqli_fetch_assoc($run)){
                            $noresult = false;
                            $threa_title = $row['thread_title'];
                            $threa_desc = $row['thread_description'];
                            $thread_id = $row['thread_id'];
                            $url = "thread.php?threadid=" . $thread_id;
                          echo  '<div class="result container">
                                <h3 class="text-dark">
                                    <a href="'. $url .'"> ' . $threa_title . '</a>
                                </h3>
                                <p>'. $threa_desc .'</p>
                            </div>';
                        }
                        if($noresult){
                            echo '<div class="container">
                            <div class="jumbotron jumbotron-fluid">
                            <h1 class="display-4">No Result Found</h1>
                            <p class="lead">Your search -'. $qye.' - did not match any documents.

                            <br><b>Suggestions</b>:
                            <ul>
                            <li>Make sure that all words are spelled correctly.</li>
                            <li>Try different keywords.</li>
                            <li>Try more general keywords.</li></p></ul>
                            
                        </div>
                            </div>';
                        }
            ?>
    </div>

    <?php include "footer.php"; ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>