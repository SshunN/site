<?php
  include_once "mainHeader.php";
  setHeadInfo("Главная");
  addStylesArray(array("style/bootstrap.min.css", "style/navigation.css"));
  inicializeHead();
?>
<body>
  <?php
  drawHeader("mainH");
  include_once "DBManager.php";
?>
</body>
