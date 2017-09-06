<?php
    $paginalineup = file_get_contents('header.txt');
    echo str_replace('[HOMEPAGE]', 'Line-Up', $paginalineup);
    echo file_get_contents('h_line-up.txt');
    echo file_get_contents('footer.txt');
?>