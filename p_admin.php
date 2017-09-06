<?php
session_start();
if (isset($_SESSION['user']) == "") {
    header("Location: p_login.php");
}
else {
    if(!isset($_SESSION['elimina_news_error'])){
        $_SESSION['elimina_news_error'] = "";
    }
    require 'dBconnect.php';
    $conn = Connect();

    $lista_news = "";

    $autore = $_SESSION['nome_completo'];
    $query = "SELECT * FROM News";
    $res = $conn->query($query);
    if($res->num_rows > 0) {
        $lista_news .= "<form class='bloccoNewsEliminabili' method='post' action='elimina_news.php'>";
        while($row = $res->fetch_assoc()) {
            $news = "\n\t<div class=\"newsEliminabile\"><input type=\"checkbox\" name='notizia_erase[]' value=\"";
            $news .= $row['id'];
            $news .= "\"><strong>Titolo:</strong>  ";
            $news .= $row['titolo'];
            $news .= " <strong>Autore:</strong> ";
            $news .= $row['autore'];
            $news .= "</input></div>\n";
            $lista_news .= $news;
        }
        $lista_news .= "<input id=\"eraseButton\" type='submit' name='elimina_news' value='Elimina News'>";
        $lista_news .= "</form>";
        $res->close();
    } else {
        $lista_news = "<p id='newsError'>Non hai ancora pubblicato alcuna news</p>";
    }

    $headerpage = file_get_contents('template/header.txt');
    echo str_replace('[HOMEPAGE]', 'Pagina di amministrazione', $headerpage);

    $messaggioErrore = "<p id='newsError'>" .  $_SESSION['elimina_news_error'] . "</p>";
    $paginaRisultati = file_get_contents('template/h_pagina_amministrazione.txt');
    $paginaRisultati = str_replace("[NOMEUTENTE]", $_SESSION['username'], $paginaRisultati);
    $paginaRisultati = str_replace("[News Titles]", $lista_news, $paginaRisultati);
    echo str_replace("[ErroreErase]", $messaggioErrore , $paginaRisultati);

    echo file_get_contents('template/footer.txt');
    $conn->close();
}
?>