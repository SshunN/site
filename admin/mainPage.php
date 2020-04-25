<?php
  require_once('pageGenerator.php');
  
  $title = "Главная страница (Админ)";
  $script = "content.php";

  $_SESSION['table'] = "News";
  $_SESSION['folder'] = "../resources/news/";
  $_SESSION['backPath'] = "../admin/mainPage.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>
