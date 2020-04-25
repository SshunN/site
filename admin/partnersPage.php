<?php
  require_once('pageGenerator.php');
  
  $title = "Партнеры";
  $script = "content.php";

  $_SESSION['table'] = "Partners";
  $_SESSION['folder'] = "../resources/partners/";
  $_SESSION['backPath'] = "../admin/partnersPage.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>