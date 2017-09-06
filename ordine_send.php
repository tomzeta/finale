<?php
session_start();
//connessione al DB
include_once 'dbConnect.php';
$conn = Connect();

if (isset($_POST['addcart'])) {
    $error = false;

    if (isset($_POST['ticket_type'])) {
        $tipologia_biglietti = $_POST['ticket_type'];
    } else {
        $error = true;
        $_SESSION['orderError'] = "Non è stata selezionata una tipologia di biglietti. ";
    }

    if (isset($_POST['num_tickets'])) {
        $num_biglietti = $_POST['num_tickets'];
    } else {
        $error = true;
        $_SESSION['orderError'] =  $_SESSION['orderError'] . "Non è stato selezionato il numero di biglietti";
    }

    if(!$error) {
        $_SESSION['orderError'] = "";
        if($tipologia_biglietti != "Abbonamento 3 giorni") {
            $prezzo = $num_biglietti * 35;
        } else {
            $prezzo = $num_biglietti * 100;
        }
        $query = "INSERT INTO Ordini(username, tipologia_biglietti, num_biglietti, tot_ordine) VALUES ('" . $_SESSION['username'] . "','" . $tipologia_biglietti . "','" . $num_biglietti . "','" . $prezzo . "')";
        $res = $conn->query($query);
        if($res) {
            $_SESSION['orderSuccess'] = "Ordine effettuato.";
            unset($num_biglietti);
            unset($tipologia_biglietti);
        } else {
            $_SESSION['orderError'] = "C'è stato un errore nel contattare il server";
        }
    }
    header("Location: p_ordini.php");
}
?>