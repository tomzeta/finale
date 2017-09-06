<?php
session_start();
include_once 'dBconnect.php';
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

//variabile di controllo errore
$error = false;

//prendo variabili in input e le formatto
$username = test_input($_POST['username_login']);
$password = test_input($_POST['password_login']);


//controllo email
if(empty($username)) {
    $error = true;
    $usernameErr = "Inserire un nome utente";
}

//controllo password
if(empty($password)) {
    $error = true;
    $passwordErr = "Inserire una password";
}

//se non ci sono errori tenta il login
if(!$error){
    $query = "SELECT id, username, nome, cognome, user_type FROM Utenti WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);
    if($result) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
    }
    $result->close();
    if ($count == 1) {
        $_SESSION['user'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['nome_completo'] = "" . $row['nome'] . " " . $row['cognome'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['login_error'] = "";

    } else {
        $_SESSION['login_error'] = "Credenziali errate, riprova...";

    }
    header("Location: p_login.php");
}

?>

