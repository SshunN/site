<?php
  $title = "default";
  $styles = array();
  $header = "";
  $scripts = "";

  function setHeadInfo($_title) { global $title; $title = $_title; }
  function addStyle($_style) { global $styles; array_push($styles, $_style); }
  function addStylesArray($_styles) { global $styles; $styles = array_merge((array)$styles, (array)$_styles); }
  function addScript($script)
  {
    global $scripts;
    $scripts = $scripts . $script;
  }
  class HeaderItem {
    private $id;
    private $link;
    private $text;
    private $script;
    function __construct($id, $link, $text, $script = "") 
    {
       $this->id = $id; 
       $this->link = $link; 
       $this->text = $text; 
       $this->script = $script;
    }
    function getID() { return $this->id; }
    function getLink() { return $this->link; }
    function getText() { return $this->text; }
    function getScript() { return $this->script; }
  }
  function setHeader(array $items)
  {
    global $header;
    $header = "
    <div><nav class='navbar navbar-light navbar-expand-md navigation-clean-button'><div class='container'>
    <div class='collapse navbar-collapse' id='navcol-1'><ul class='nav navbar-nav mr-auto'>";
    for($i = 0; $i < count($items); $i++)
    {
      $h = $items[$i];
      $header = $header . "<li class='nav-item' role='presentation'>
      <a id='" . $h->getID() . "' class='nav-link' href='" . $h->getLink() . "' onclick='" . $h->getScript() . "'>"
       . $h->getText() . "</a></li>";
    }
    $header = $header . "</ul></div></div></nav></div>";
  }

  function inicializePage()
  {
    global $title, $styles, $scripts, $header;
    echo "<!DOCTYPE html><html lang='ru' dir='ltr'><head><meta charset='utf-8'>";
    echo "<title>$title</title>";
    for ($i = 0; $i < count($styles); $i++){$s = $styles[$i];echo "<link rel='stylesheet' href=$s>"; }
    echo "</head>";
    echo "<body>";
    echo "<script>" . $scripts . "</script>";
    echo $header;
    echo "</body>";
  }
 ?>