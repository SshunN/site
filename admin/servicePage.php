<?php
  require_once('pageGenerator.php');

  $title = "Услуги";
  $script = "content.php";

  $_SESSION['table'] = "Services";
  $_SESSION['folder'] = "../resources/services/";
  $_SESSION['backPath'] = "../admin/editService.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>