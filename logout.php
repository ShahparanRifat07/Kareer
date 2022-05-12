<?php
    session_start();
    session_destroy();
    // unset($_SESSION['USERID']);
    // unset($_SESSION['LOGGEDIN']);
    header("Location: login.php");
?>
