<?php
session_start();
require 'dBconnect.php';
$conn = Connect();

function test_input($data)
{
    //toglie spazi inizio e fine del testo
    $data = trim($data);
    //toglie le virgolette
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
}

$_SESSION['form_info_error'] = "";

$nome = test_input($_POST['firstname']);
$cognome = test_input($_POST['lastname']);
$email= test_input($_POST['email']);
$oggetto = $_POST['motivazione'];
$messaggio= test_input($_POST['message']);



$errore = false;
if (empty($nome)) {
    $errore = true;
    $_SESSION['form_info_error'] = "Inserire un nome. ";
} else if (!preg_match("/^[a-zA-z ]*$/", $nome)) {
    $errore = true;
    $_SESSION['form_info_error'] = "Per il nome sono consentite solo lettere e spazi. ";
}
if (empty($cognome)) {
    $errore = true;
    $_SESSION['form_info_error'] .= "Inserire un cognome. ";
} else if (!preg_match("/^[a-zA-z ]*$/", $cognome)) {
    $errore = true;
    $_SESSION['form_info_error'] .= "Per il cognome sono consentite solo lettere e spazi. ";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errore = true;
    $_SESSION['form_info_error'] .= "Inserire un indirizzo email valido. ";
}
if(empty($messaggio)){
    $errore = true;
    $_SESSION['form_info_error'] .= "Inserire il messaggio che volete inviare. ";
}
if(!$errore) {
    $query="INSERT INTO Messaggi(nome, cognome, email, oggetto, messaggio) VALUES ('" . $nome . "','" . $cognome . "','" . $email . "','" . $oggetto . "','" . $messaggio . "')";
    $res = $conn->query($query);
    if($res) {
        $_SESSION['form_info_error'] = "Il tuo messaggio è stato inviato. ";
    } else {
        die("Non si possono inserire i dati: " . $conn->error);
    }
}
$conn->close();
header("Location: p_info.php");


?>