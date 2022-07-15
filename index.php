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
        .container123{
            min-height: 100vh;
        }
    </style>
</head>

<body class="container123">

    <?php include 'essential/_nav.php'; ?>

    
    <?php include 'essential/_dbconnect.php'; ?>
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://source.unsplash.com/1600x400/?coding,php" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x400/?development,html" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://source.unsplash.com/1600x400/?coding,programming" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container my-3">
        <h1 class="text-center my-3"> IAsk </h1>
        <div class="row">
            <?php
            $sql = "SELECT * FROM categories ORDER BY RAND ( ) LIMIT 30";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {

                $desc = '<a href="https://en.wikipedia.org/wiki/'. $row['category_name'] . '">Show</a>';
                $id = $row['category_id'];
                echo '<div class="col-md-4 my-2">
                   <div class="card" style="width: 18rem;">
                   <img src="https://source.unsplash.com/1600x900/?' . $row['category_name']. ',coding" class="card-img-top" alt="...">
                   <div class="card-body">
                     <h5 class="card-title">'. $row['category_name'] . '</h5>
                     <p class="card-text">' . $row['category_description'] . '</p>
                     <a href="thread_list.php?catid=' . $id . '" class="btn btn-primary">view threads</a>
                   </div>
                 </div>
                   </div>';
            }
            ?>




        </div>
    </div>


    <?php include "footer2.php"; ?>

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