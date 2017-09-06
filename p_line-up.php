<?php
    $paginalineup = file_get_contents('template/header.txt');
    echo str_replace('[HOMEPAGE]', 'Line-Up', $paginalineup);
    echo file_get_contents('template/h_line-up.txt');
    echo file_get_contents('template/footer.txt');
?>