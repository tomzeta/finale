<?php
$paginahome = file_get_contents('template/header.txt');
echo str_replace('[HOMEPAGE]', 'Error', $paginahome);
echo file_get_contents("template/h_errore.txt");
echo file_get_contents("template/footer.txt");
?>