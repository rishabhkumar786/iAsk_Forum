<?php include "essential/_dbconnect.php";
    include "essential/_nav.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Anwers</title>
    
    <style>
        .vl {
            border-left: 6px solid green;
            height: 500px;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            
            
            <div class="col-8">
                <!-- <div class="vl"> -->
                    <h4> Questions for You </h4>
                    
                    <div class="container">
                        <?php
                            $sql1 = "SELECT * FROM question_bank ORDER BY RAND ( ) LIMIT 30";
                            $result1 = mysqli_query($conn, $sql1);
                            while($row = mysqli_fetch_assoc($result1)){
                                $question = $row['Title'];
                                $tags = $row['Tags'];
                                $desc = $row['Description'];
                                $cat = $row['Categories'];
                                $question_id = $row['Sno'];
                                
                                $sql2 = "SELECT * FROM question_bank_answers WHERE question_id=$question_id";
                                $result2 = mysqli_query($conn, $sql2);
                                $total_answers = mysqli_num_rows($result2);

                                echo '
                                    <div class="p-3 mb-5 bg-dark text-dark">
                                        <h3 class="fw-bold">'. $question .'</h3> <p class="fst-italic fw-light">tags: '. $tags .'</p>
                                        <p> '. $total_answers  .' Answers Yet</p>
                                        
                                        <p class="text-start">
                                        <button class="btn" data-bs-toggle="collapse" href="#collapseExample'. $question_id .'" aria-expanded="false" aria-controls="collapseExample"><img width="30" height="30"src="essential/pen.png"></i></button>
                                        <button class="btn"><img width="30" height="30"src="essential/follow.png"></i></button>
                                        <button class="btn"><img width="30" height="30"src="essential/star_unset.png"></i></button> 
                                        &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                                        
                                        
                                            <button id = "downvote_'. $question_id .'" class="btn downvote">
                                                <span id = "span_'. $question_id .'">
                                                     <img width="30" height="30" src="essential/downvote_unset.png"></i>
                                                </span>
                                            </button>
                                        
                                        
                                        <button class="sharethis-inline-share-buttons"></button>
                                        <button class="btn"><img width="30" height="30" src="essential/more.png"></i></button></p>
                                        
                                        <div class="collapse" id="collapseExample'. $question_id .'">
                                            <div class="card card-body">
                                               
                                                <form method="post" class="answer_form" id="answer_form'. $question_id .'"  onsubmit="return false">
                                                    <div class="form-floating">
                                                        <textarea type="text" class="form-control" name="textanswer"  id="answer_form_area'. $question_id .'" style="height: 100px"></textarea>
                                                        <label for="floatingTextarea2"> Write Your Answer</label>
                                                    </div>
                                                    <input type="hidden" name="question_id" value="'. $question_id .'">
                                                    <span id="answer_post_button'. $question_id .'">
                                                        <button type="submit" class="mt-2 btn btn-primary answer_submitt_button">Post</button>
                                                    </span>
                                                </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                        
                    </div>


                <!-- </div> -->

            </div>
            <div class="col-2">
                <!-- <div class="vl"> -->
               
                <!-- </div> -->
            </div>
        </div>
        
    </div>

    
    
  
  
  
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="javascript/anwers.js"></script>
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=61f438516346030019493cd5&product=inline-share-buttons" async="async"></script>
</body>
</html>