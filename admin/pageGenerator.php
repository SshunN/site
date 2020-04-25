<?php
  session_start();
  class HeaderItem {
    
    private $title;
    private $script;

    function Init($_title, $_script)
    {
      $this -> title = $_title;
      $this -> script = $_script; 
    }
    function inicializeHead()
    {
      echo '<!DOCTYPE html>
            <html lang="ru" dir="ltr">
              <head>
                <meta charset="utf-8">
                <title>';
      echo $this -> title;
      echo '</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <link rel="stylesheet" href="style/bootstrap.min.css"/>
                <link rel="stylesheet" href="style/navigation.css">
              </head>';
    }
    function inicializeBody()
    {
      echo "<body>";
      include 'editHeader.html';
      require_once($this -> script);
      echo "</body>
          </html>";
    } 
  }
?>