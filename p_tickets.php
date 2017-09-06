<?php
$headerpage = file_get_contents('template/header.txt');
echo str_replace('[HOMEPAGE]', 'Biglietti', $headerpage);
echo file_get_contents('template/h_tickets.txt');
echo file_get_contents('template/footer.txt');
?>