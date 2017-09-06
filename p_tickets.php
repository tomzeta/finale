<?php
$headerpage = file_get_contents('header.txt');
echo str_replace('[HOMEPAGE]', 'Biglietti', $headerpage);
echo file_get_contents('h_tickets.txt');
echo file_get_contents('footer.txt');
?>