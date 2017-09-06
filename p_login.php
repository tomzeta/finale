<?php
session_start();
if(!isset($_SESSION['login_error'])) {
    $_SESSION['login_error'] = "";
}
if(isset($_SESSION['user'])!="" ) {
    if ($_SESSION['user_type'] == "admin") {
        header("Location: p_admin.php");
    } else if ($_SESSION['user_type'] == "user") {
        header("Location: p_ordini.php");
    }
} else {
    $headerpage = file_get_contents('header.txt');
    echo str_replace('[HOMEPAGE]', 'Login', $headerpage);

    $page = file_get_contents("h_login.txt");
    echo str_replace('[ERRORE]',$_SESSION['login_error'], $page);
    echo file_get_contents('footer.txt');
}
?>