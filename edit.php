<?php
include "essential/_dbconnect.php";
include "essential/_nav.php";
?>
<?php
$ok = false;
if (isset($_GET['password'])) {
    $pass = $_GET['password'];
    $user_name = $_SESSION['username'];
    $sql = "SELECT * FROM signup WHERE username='$user_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fpass = $row['password'];

    if ($pass == $fpass) {
        $ok = true;
        echo "<script> alert('password matched')</script>";
    } else {
        $ok = false;
        echo "<script> alert('password do not matched')</script>";
    }
}
else if(isset($_GET['change'])){
    $name = $_GET['change'];
    $sql = "SELECT * FROM signup WHERE username='$name'";
    $result2 = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result2);
    if($num){
        die('username exists');
    }
    else
    $id = $_SESSION['userid'];
    $sql2 = "UPDATE signup SET username='$name' WHERE user_id = $id";
    $result3 = mysqli_query($conn, $sql2);
    if($result3){
        die("updated");
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if ($ok) {
        echo '<div class="container">
        <form action="edit.php"method="get">
            <h6>Type New UserName</h6>
            
            <input type="text" name="change">
            <button type="submit"  class="btn btn-primary">change</button>
        </form>

    </div>';
    } else {
        echo '<div class="container text-center">
            <h2>Confirm Your Password First!!<h2>
                    <form action="edit.php" method="get">
                        <div class="mb-3 mx-5">
                            <label for="exampleInputPassword1" class="text-left form-label">Password</label>
                            <input type="password" value="cpass" class="form-control" name="password" id="exampleInputPassword1">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
        </div>';
    }

    ?>





</body>

</html>