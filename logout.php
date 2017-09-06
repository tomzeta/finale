<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: p_login.php");
    }
        unset($_SESSION['user']);
        session_unset();
        session_destroy();
        header("Location: p_login.php");
        exit;
?>
