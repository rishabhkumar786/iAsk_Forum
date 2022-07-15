<?php
    session_start();
    session_unset();
    session_destroy();
    $_SESSION['loggedin'] = false;
    
    header("location: index.php");
?>