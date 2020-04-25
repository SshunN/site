<?php
  require_once('pageGenerator.php');
  
  $title = "Товары категорий";
  $script = "content.php";

  $_SESSION['table'] = "GoodsCategory";
  $_SESSION['folder'] = "../resources/goods/";
  $_SESSION['backPath'] = "../admin/goodsPage.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>