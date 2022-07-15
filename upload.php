<?php 
// Include the database configuration file  
include 'essential/_dbconnect.php'; 
 
// If file upload form is submitted 
$status = $statusMsg = ''; 
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $sql = "INSERT INTO `signup` (`username`, `password`, `image`) VALUES ('rishabh', 'password', '$imgContent')"; 
            $insert = mysqli_query($conn, $sql);
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 
 
// Display status message 
echo $statusMsg; 
?>

<?php 
// Include the database configuration file  
include 'essential/_dbconnect.php'; 
 
// Get image data from database 
$run = "SELECT image FROM signup ORDER BY uploaded DESC";
 $result = mysqli_query($conn, $run);
 if(!$result)
    die("Not done!!");
$num = mysqli_num_rows($result);
?>

<?php if($num > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = mysqli_fetch_assoc($result)){ ?> 
            <img src="data:capture/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>



