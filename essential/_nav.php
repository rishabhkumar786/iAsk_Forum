<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="javascript/contact.js"></script>
<?php
  function image_fetch()
  {
      include "essential/_dbconnect.php";
      $id = $_SESSION['userid'];
      $sql = "SELECT * FROM signup WHERE user_id= $id";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      if ($row['image'] != NULL) return $row['image'];
      else  return "uploads/user.png";
  }
?>
<?php
include "_dbconnect.php";
session_start();
if (isset($_SESSION['username'])) {
  include "check_req.php";
  

  // echo $f;
  echo '<nav class="navbar navbar-expand-lg navbar-blue bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">IAsk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Login System/index.php">welcome</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Login System/feeds.php">Feeds</a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/Login System/answers.php">Answers</a>
      </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Threads
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a href="create_new_thread.php"><button  class="btn btn-danger"> create own thread</button></a></li>';
          $sql = "SELECT category_id, category_name FROM categories LIMIT 3";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<li><a class="dropdown-item" href="../Login System/thread_list.php?catid='. $row['category_id'] .'">'. $row['category_name'] .'</a></li>';
          }
          
        
        
        echo '</ul>
      </li>
        <li class="nav-item">
          <a class="nav-link" href="/Login System/logout.php" tabindex="-1" aria-disabled="true">Logout</a>
        </li>
      </ul>
      <div class="nav-item dropdown">
          <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="true">
          <img class="" src="upload/' .image_fetch().'" title="' . $_SESSION['username'] . '" width="40px alt="photo">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/Login System/profile.php">View Profile </a>
            <a class="dropdown-item" href="#">Notifications <span id="notification" class="badge bg-dark">4</span>+</a>
            <a class="dropdown-item" href="/Login System/my_thread.php">Your Threads</a>
            <a class="dropdown-item" href="#">Messages <span id="messages" class="badge bg-dark">4</span>+</a>
            <a class="dropdown-item" href="#">Contribution</a>
            <a class="dropdown-item" href="/Login System/essential/requests.php">Requests <span id="requests" class="badge bg-dark">' .$f. '</span></a>
            <a class="dropdown-item" href="/Login System/settings.php">Settings</a>
          </div>
      </div>
      <a href="/Login System/ask_new_question.php" type="button" class="btn btn-danger">Ask Question</a>
      <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
      
      
    

      
    </div>
  </div>
</nav>';
} else {
  echo '<nav class="navbar navbar-expand-lg navbar-blue bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iAsk</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">welcome</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="feeds.php">Feeds</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Threads
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
          $sql = "SELECT category_id, category_name FROM categories LIMIT 3";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
          
          echo '<li><a class="dropdown-item" href="../Login System/thread_list.php?catid='. $row['category_id'] .'">'. $row['category_name'] .'</a></li>';
        }
        
        
        echo '</ul>
      </li>
      
        <li class="nav-item">
          <a class="nav-link" href="signup.php">signUp</a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link" href="login.php" tabindex="-1" aria-disabled="true">Login</a>
        </li>
       
      </ul>
      
        <form class="d-flex" action="search.php" method="get">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <a class="btn btn-outline-success" href="login.php" role="button">Login</a>
        <a class="btn btn-outline-success" href="signup.php" role="button">SignUp</a>
      
    </div>
  </div>
</nav>';
}
