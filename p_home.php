<?php
    $paginahome = file_get_contents('template/header.txt');
    echo str_replace('[HOMEPAGE]', 'Home', $paginahome);
      echo file_get_contents("template/h_home.txt");
  	  echo file_get_contents("template/footer.txt");
?>