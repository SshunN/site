<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Товары</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    </style>
  </head>
  <body>
    <?php 
      include_once 'mainHeader.php';
      include_once 'DBManager.php';
      drawHeader("goodH");
      $catID = $_GET['category'];
      $res = select("Goods", array("nameImg", "id", "title", "description"), "categoryID = $catID");
      echo "<div class='article-list'><div class='container'><div class='row articles'>";
      foreach($res as $r)
      {
        $i = $r->getFieldByName('nameImg');
        $id = $r->getFieldByName('id');
        $title = $r->getFieldByName('title');
        $desc = $r->getFieldByName('description');
        echo "<div class='col-sm-6 col-md-4 item'>
        <img class='img-fluid' src='resources/goods/cond/$i' />
        <h3 class='name'>$title</h3>
        <p class='description'>$desc</p>
        <input type='hidden' id='$id' value=$id>
        <input type='number' id='count$id' onchange='checkValue($id)' min='0' max='20' value = '0'>
        <button hidden='true' id='but$id' onclick='addToCart($id, `$title`, $catID, getGoodCount($id))'>Добавить в корзину</button>
        </div>";
      }
      echo "</div></div></div>";
    ?>
    <script>
    changePage("goodH");
    function getGoodCount(id) { return document.getElementById('count' + id).value; }
    function checkValue(id){  
      var el = document.getElementById("count" + id);
      var but = document.getElementById('but' + id);
      if(el.value <= 0) { el.value = 0; but.hidden = true; }
      else { but.hidden = false; if(el.value > 20) el.value = 20; }
    }
    </script>
    </body>
</html>