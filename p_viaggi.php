<?php
      $paginatrip = file_get_contents('template/header.txt');
      echo str_replace('[HOMEPAGE]', 'Viaggi', $paginatrip);
      echo file_get_contents('template/h_viaggi.txt');
  	  echo file_get_contents('template/footer.txt');
?>