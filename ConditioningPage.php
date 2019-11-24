<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>new site title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
  </head>
  <body>
    <?php include 'mainHeader.php'; ?>
    <script>changePage("goodH");</script>
<table>
  <tbody>
    <?php
      $db = new SQLite3('resources/data.sqlite');
      $res = $db->query('SELECT * FROM Services');
      while ($row = $res->fetchArray()) {
        echo "<tr>";
        $i = $row['nameImg'];
        $id = $row['id'];
        $title = $row['title'];
        echo "<td width='400'><img src='resources/goods/cond/$i' width='350' height='200'></td>";
        echo "<td width='150'><h5>{$title}</h5></td>";
        echo "<td width='150'><h5>{$row['description']}</h5></td>";

        echo "<td width='300'>
        <input type='hidden' id='$id' value=$id>
        <input type='number' id='count$id' onchange='checkValue(id)' min='1' max='20' value = '1'>
        <button id='but$id' onclick='addToCart($id, `$title`)'>Добавить в корзину</button>
        </td>";
        echo "</tr>";
      }
    ?>
    <tbody>
  </table>
  </body>
</html>
<script>
function checkValue(id){
  el = document.getElementById(id);
  if(el.value > 20) el.value = 20;
  if(el.value < 1) el.value = 1;
}
</script>
