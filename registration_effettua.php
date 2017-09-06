<?php
session_start();
require 'dBconnect.php';
$conn = Connect();

//funzione per formattare l'input
function test_input($data)
{
    //toglie spazi inizio e fine del testo
    $data = trim($data);
    //toglie le virgolette
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
}

$errore = false;
$nome = test_input($_POST["nome_reg"]);
$cognome = test_input($_POST["cognome_reg"]);
$username = test_input($_POST["username_reg"]);
$email = test_input($_POST["email_reg"]);
$password = test_input($_POST["password_reg"]);


//gestione errori per campo $nome
if (empty($nome)) {
    $errore = true;
    $_SESSION['nomeErr'] = "Inserire un nome utente";
} else if (!preg_match("/^[a-zA-z ]*$/", $nome)) {
    $errore = true;
    $_SESSION['nomeErr'] = "Per il nome sono consentite solo lettere e spazi";
} else {
    //nessun errore, resetto variabile errore
    $_SESSION['nomeErr'] = "";
}

//gestione errori campo cognome
if (empty($cognome)) {
    $errore = true;
    $_SESSION['cognomeErr'] = "Inserire un cognome";
} else if (!preg_match("/^[a-zA-z ]*$/", $cognome)) {
    $errore = true;
    $_SESSION['cognomeErr'] = "Per il cognome sono consentite solo lettere e spazi";
} else {
    //nessun errore, resetto variabile errore
    $_SESSION['cognomeErr'] = "";
}

//gestione errori campo utente
if (empty($username)) {
    $errore = true;
    $_SESSION['usernameErr'] = "Inserire un nome utente";
} else if(strlen($username) < 6) {
    $errore = true;
    $_SESSION['usernameErr'] = "Il nome utente deve avere almeno 6 caratteri";
} else {
    $query = "SELECT username FROM Utenti WHERE username = '$username'";
    $result = $conn->query($query);
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        $errore = true;
        $_SESSION['usernameErr'] = "Nome utente già in uso";
    } else {
        //nessun errore, resetto variabile errore
        $_SESSION['usernameErr'] = "";
    }
}

//gestione errori per campo $email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errore = true;
    $_SESSION['emailErr'] = "Inserire un indirizzo email valido";
} else {
    //controlla se email esiste o no
    $query = "SELECT email FROM Utenti WHERE email = '$email'";
    $result = $conn->query($query);
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        $errore = true;
        $_SESSION['emailErr'] = "Indirizzo email già in uso";
    } else {
        //nessun errore, resetto variabile errore
        $_SESSION['emailErr'] = "";
    }
}

//gestione errori per campo $password
if (empty($password)) {
    $errore = true;
    $_SESSION['passwordErr'] = "Inserire una password";
} else if (strlen($password) < 6) {
    $errore = true;
    $_SESSION['passwordErr'] = "Inserire una password di almeno 6 caratteri";
} else {
    //nessun errore, resetto variabile errore
    $_SESSION['passwordErr'] = "";
}

//se non c'è errore inserisci dati nel DB
if(!$errore){
    $query = "INSERT INTO Utenti(nome, cognome, email, username, password) VALUES('" . $nome . "','" . $cognome . "','" . $email . "','" . $username . "','" . $password . "')";
    $res = $conn->query($query);
    if ($res) {
        unset($nome);
        unset($cognome);
        unset($username);
        unset($email);
        unset($password);
        header("Location: p_login.php");
    }
    else {
        die("Non si possono inserire i dati: " . $conn->error);
    }
} else {
    header("Location: p_registration.php");
}
$conn->close()
?>