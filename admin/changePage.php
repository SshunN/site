<?php
  require_once('pageGenerator.php');
  
  $title = "Изменение записи";
  $script = "changeContent.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>