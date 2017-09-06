<?php
session_start();
if(!isset($_SESSION['form_info_error'])){
    $_SESSION['form_info_error'] = "";
}
    $headerinfo = file_get_contents('template/header.txt');
    echo str_replace('[HOMEPAGE]', 'Info', $headerinfo);
    $paginainfo = file_get_contents('template/h_info.txt');
    echo str_replace('[ERRORE_INFO]', $_SESSION['form_info_error'], $paginainfo);
    echo file_get_contents('template/footer.txt');
?>