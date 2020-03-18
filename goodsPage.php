<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Товары</title>
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
    <style>
    .article-list { color:#313437; background-color:#fff; }
    .article-list .articles { padding-bottom:40px; }
    .article-list .item { padding-top:50px; min-height:425px; text-align:center; }
    .article-list .item .name {font-weight:bold;font-size:16px;margin-top:20px;color:inherit;}
    .article-list .item .description { font-size:14px; margin-top:15px; margin-bottom:0; }
    .img-fluid { max-width:300px; max-height:300px; }
    img { vertical-align:middle; border-style:none; }
    footer {background-color:#292c2f;box-sizing:border-box;width:100%;text-align:left;font:bold 16px sans-serif;padding:30px;bottom:0;color:#fff;}
    .footer-navigation p.company-name {color:#8f9296;font-size:14px;font-weight:normal;margin-top:20px;}
    .footer-navigation h3 a {text-decoration:none;color:#fff;}
    .footer-navigation h3 {margin:0;font:normal 36px Cookie, cursive;margin-bottom:20px;color:#fff;}
    </style>
  </head>
  <body>
   <?php 
      include_once "mainHeader.php";
      drawHeader("goodH");
      include_once "DBManager.php";
      $array = select("GoodsCategory", array("nameImg", "title", "id", "description"));
      echo "<div class='article-list'><div class='container'><div class='row articles'>";
      for($i = 0; $i < count($array); $i++)
      {
        $r = $array[$i];
        echo "<div class='col-sm-6 col-md-4 item'>
        <img class='img-fluid' src='resources/goods/cond/" . $r->getFieldByName("nameImg") . "' />
        <a href='GoodsPageGenerator.php?category=" . $r->getFieldByName("id") . "'><h3 class='name'>" . 
        $r->getFieldByName("title") . "</h3></a>
        <p class='description'>" . $r->getFieldByName("description") . "</p></div>";
      }
      echo "</div></div></div>";
    ?>
    </tr>
    <?php include 'Footer.html'; ?>
    </body>
</html>

