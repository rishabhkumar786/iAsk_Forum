<?php include "essential/_dbconnect.php";
    include "essential/_nav.php";
?>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['Title'];
        $desc = $_POST['description'];
        $category = $_POST['category'];
        $visibility = $_POST['visibility'];
        $final_tags = "";
        $id = $_SESSION['userid'];
        if(!empty($_POST['checkbox'])){
          $tags = $_POST['checkbox'];
          $value = "";
          foreach($tags as $value){
              $final_tags = $final_tags . ' ' . $value;
          }
        }

        $sql1 = "INSERT INTO `question_bank` (`User_id`,`Title`, `Description`, `Tags`, `Categories`, `Visibility`) 
                  VALUES ('$id','$title', '$desc', '$final_tags', '$category', '$visibility')";
        $result1 = mysqli_query($conn, $sql1);

      


    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> New Question</title>
    <style>

    </style>
</head>

<body>
<div class="container">
<form action="ask_new_question.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Title</label>
    <input type="Text" name="Title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <small id="emailHelp" class="form-text text-muted">Enter a effective title</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Title Description</label>
    <input type="text" name="description" class="form-control" id="exampleInputPassword1">
  </div>
  <br>
  <div class="form-group">
    <select name="visibility" width="10px" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <option name="visibility" selected>Select Visibility</option>
        <option  value="Public">Public</option>
        <option  value="Private">Private</option>
        <option  value="Limited">Limited</option>
    </select>
  </div>
  <br>
  <div class="form-group">
  <label for="exampleInputPassword1">Write Categories</label>
  <input type="text" name="category" class="form-control" id="exampleInputPassword1">
  </div>
  <br>
  <div class="form-group">
    <label for="exampleInputPassword1">Tags</label>
        <br/>
        <input  type="checkbox" name="checkbox[]" value="General"/> GENERAL <br/><br/>
        <input  type="checkbox" name="checkbox[]" value="trending"/> TRENDING<br/><br/>
        <input  type="checkbox" name="checkbox[]" value="new"/> NEW<br/><br/>
        <input  type="checkbox" name="checkbox[]" value="tech"/> TECH<br/><br/>
        
       <br/>
  </div>


  




 
  <button href="#" type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</body>
</html>