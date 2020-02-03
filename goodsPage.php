<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Товары</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
    <style>
    .projects-clean .projects { padding-bottom:40px; }
    .row {display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:10px;}
    @media (min-width:100px) {.col-sm-6 { -ms-flex:0 0 50%; flex:0 0 50%; max-width:30%; }}
    @media (min-width:100px) {.col-lg-4 { -ms-flex:0 0 30%; flex:0 0 30%; max-width:30%; }}
    .projects-clean .item { text-align: center; padding-top: 50px; min-height: 100px; }
    .img-fluid { max-width:100%; height:auto;}
    </style>
  </head>
  <body>
   <?php 
      include 'mainHeader.php';
      $db = new SQLite3('resources/data.sqlite');
      $res = $db->query('SELECT * FROM GoodsCategory');
      echo "<div class='row projects'>";
      while ($row = $res->fetchArray()) {
        $image = $row['nameImg'];
        $title = $row['title'];
        $id = $row['id'];
        $desc = $row['description'];

        echo "<div class='col-sm-6 col-lg-4 item'>";
        if($image != '') echo "<img class='img-fluid' src='resources/goods/cond/$image'/>";
        echo "<p style='text-align:center;' ><a href='PageGenerator.php?category=$id'>$title</a></p>";
        echo "<p style='text-align:center;' >$desc</p>";
        echo "</div>";
      }
      echo "</div>";
    ?>
    </tr>
    <script>changePage("goodH");</script>
    </body>
</html>

