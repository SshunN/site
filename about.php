<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>О нас</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
  </head>
  <body>
    <?php 
    include_once 'mainHeader.php';
    drawHeader("aboutH");
    ?>
    <script>changePage("aboutH");</script>
    <div>
      <?php
      $fp = fopen("resources/mainPage.txt", "r");
      if ($fp)
      {
        while (!feof($fp))
        {
          $mytext = fgets($fp, 999);
          echo "<h5 style='margin:20px;'>$mytext</h5>";
        }
      }
      fclose($fp);
      ?>
    </div>
  </body>
</html>
