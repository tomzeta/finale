<?php
require 'dBconnect.php';
$conn = Connect();

$query = "SELECT * FROM News ORDER BY id DESC";
$res = $conn->query($query);
if($res->num_rows > 0) {
    while($row = $res->fetch_assoc()) {
        $news = "<div class=\"NewsContainer\">";
        $news .="<div class=\"newsContent\">";
        $news .= "<h2>" . $row['titolo'] . "</h2>";
        $news .= "<p class=\"autore\"><em>" . $row['autore'] . "</em></p>";
        $news .= "<p>" . $row['testo'] . "</p></div></div>";
        $lista_news .= $news;
    }
    $res->close();
} else {
    $lista_news = "<p><span lang='eng'>Stay tuned!</span></p>";
}

$headerpage = file_get_contents('template/header.txt');
echo str_replace('[HOMEPAGE]', 'News', $headerpage);

$paginaRisultati = file_get_contents('template/h_news.txt');

echo str_replace('[CONTENUTO]', $lista_news, $paginaRisultati);

echo file_get_contents('template/footer.txt');
?>