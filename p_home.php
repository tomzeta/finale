<?php
    $paginahome = file_get_contents('header.txt');
    echo str_replace('[HOMEPAGE]', 'Home', $paginahome);
      echo file_get_contents("h_home.txt");
  	  echo file_get_contents("footer.txt");
?>