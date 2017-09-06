<?php
session_start();
require 'dBconnect.php';
$conn = Connect();
if(isset($_POST['elimina_news'])){
    $notizia_erase = $_POST['notizia_erase'];
    if(!$notizia_erase == "") {
        $news_eliminate = 0;
        foreach ($notizia_erase as $news => $value) {
            $query = "DELETE FROM News WHERE id = '$value'";
            $res = $conn->query($query);
            if ($res) {
                $news_eliminate = $news_eliminate + 1;
            } else {
                $_SESSION['elimina_news_error'] = "Qualcosa è andato storto, non hai eliminato nulla";
            }
        }
        $_SESSION['elimina_news_error'] = "Hai eliminato " . $news_eliminate . " News";
    } else {
        $_SESSION['elimina_news_error'] = "Non hai selezionato una notizia da eliminare.";
    }
    $conn->close();
    header("Location: p_admin.php");
}
?>