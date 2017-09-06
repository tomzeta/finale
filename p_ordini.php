<?php
session_start();
require 'dBconnect.php';
$conn = Connect();

if(!isset($_SESSION['[orderError]'])){
    $_SESSION['[orderError]'] = "";
}
if(isset($_SESSION['user'])== ""){
    header("Location: p_login.php");
} else {
    //Biglietti Ordinati
    $utente = $_SESSION['username'];
    $lista_ordini = "";
    $query = "SELECT id_ordine, tipologia_biglietti, num_biglietti, tot_ordine FROM Ordini WHERE username = '$utente'";
    $res = $conn->query($query);
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $ordine = "<div class=\"order\"><h3>Ordine: </h3>";
            $ordine .="<p><span class=\"orderBold\">ID: </span> " . $row['id_ordine'] . "<span class=\"orderBold\"> Tipologia: </span> " . $row['tipologia_biglietti'] . "<span class=\"orderBold\"> Numero biglietti ordinati: </span> " . $row['num_biglietti'] . "<span class=\"orderBold\"> Tot: </span> " . $row['tot_ordine'] . "&#8364;</p></br>";
            $ordine .="</div>";
            $lista_ordini .= $ordine;
        }
        $lista_ordini .= "<p class='orderError'>Verrai contattato a breve per definire i dettagli dell'acquisto.</p>";
        $res->close();
    } else {
        $lista_ordini = "<p>Non è stato effettuato ancora alcun ordine.</p>";
    }

    $headerpage = file_get_contents('header.txt');
    echo str_replace('[HOMEPAGE]', 'Pagina Utente', $headerpage);

    $paginaRisultati = file_get_contents('h_ordini.txt');
    $paginaRisultati = str_replace("[NOMEUTENTE]", $utente, $paginaRisultati);
    $paginaRisultati = str_replace("[ORDINI]", $lista_ordini, $paginaRisultati);
    echo str_replace('[ERROREORDINE]', $_SESSION['orderError'], $paginaRisultati);
    echo file_get_contents('footer.txt');
}
?>