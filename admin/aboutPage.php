<?php
	require_once('pageGenerator.php');
  
  $title = "О нас";
  $script = "aboutContent.php";
  
  $headerObject = new HeaderItem;
  $headerObject -> Init($title, $script);
  $headerObject -> inicializeHead();
  $headerObject -> inicializeBody();
?>
