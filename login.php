<?php
$showAlert = false;
$showError = false;
$exits = false;
$login = false;
$showError_2 = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'essential/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $sql = "SELECT * FROM `signup` where username = '$username'";
    $run = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($run);
    
    if($num >= 1){
       $row = mysqli_fetch_assoc($run);
       $password = hash('md5', $password);
      //  echo $password;
        if(($password == $row['password'])){
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['userid'] = $row['user_id'];
          header("location: index.php?sessionPassed=true");
        }
        else{
         $showError = true;
       }
      
    }
    else
      $showError = true;
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <style>

      .center_div{
          margin: auto;
          width:800%;
      }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
  <?php include 'essential/_nav.php'; ?>
  
   <?php 
    if($showAlert){
      echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your account is now created and you can login
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
      }
      if($showError){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Success!</strong> User Not found!!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
      }
      if($showError_2){
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Success!</strong>Incorrect Password!!!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
          </button>
      </div> ';
      }
   ?>
  <h1 class="text-center">Login to this</h1>
  <div class="container d-inline-flex p-4 center_div">
     
     <form action="login.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
         
        <button type="submit" class="btn btn-primary">Login</button>
         <form action="signup.php">
            <button type="submit" class="btn btn-primary">Signup</button>
          </form>
     </form>
    </div>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>