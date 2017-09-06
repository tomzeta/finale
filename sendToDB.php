<?php
session_start();
    require 'dBconnect.php';
    $conn = Connect();

    function formatta_stringa($stringa) {
        //sostituisco i caratteri speciali in entità html
        $stringa = htmlentities($stringa);
        $stringa = trim($stringa);
        $stringa = str_replace("'","&apos;", $stringa);
        //permetto l'utilizzo dei tag
        // <strong>
        $stringa = str_replace("&lt;strong&gt;","<strong>", $stringa);
        $stringa = str_replace("&lt;/strong&gt;","</strong>", $stringa);
        // e <em>
        $stringa = str_replace("&lt;em&gt;","<em>", $stringa);
        $stringa = str_replace("&lt;/em&gt;","</em>", $stringa);
        return $stringa;
    }

    $titolo = formatta_stringa($_POST['title']);
    $testo = formatta_stringa($_POST['testo']);
    $autore = formatta_stringa($_SESSION['nome_completo']);

    $query = "INSERT into News(titolo, testo, autore) VALUES('" . $titolo . "','" . $testo . "','" . $autore . "')";
    $success = $conn->query($query);
    if(!$success){
        die("Non si possono inserire i dati: ".$conn->error);
    }

    $conn->close();
    header("Location: p_news.php");
?>