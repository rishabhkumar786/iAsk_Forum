<?php include "_dbconnect.php";?>
<?php

$regist = $_POST['reg'];
$answer= $_POST['type1'];
$ques_id= $_POST['type2'];
//echo '<script> console.log("in functions.php file") </script>';
    
if($regist == "success"){
    
    $sql = "INSERT INTO `question_bank_answers`  VALUES ('$ques_id', '$answer')";
    $result = mysqli_query($conn, $sql);
}
?>