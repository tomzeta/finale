<?php
      $paginatrip = file_get_contents('header.txt');
      echo str_replace('[HOMEPAGE]', 'Viaggi', $paginatrip);
      echo file_get_contents('h_viaggi.txt');
  	  echo file_get_contents('footer.txt');
?>