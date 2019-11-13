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
    <?php include 'mainHeader.html'; ?>
<table>
  <tbody>
    <?php
      $db = new SQLite3('resources/data.sqlite');
      $res = $db->query('SELECT * FROM Services');
      while ($row = $res->fetchArray()) {
        echo "<tr>";
        $i = $row['nameImg'];
        echo "<td width='400'><img src='resources/goods/cond/$i' width='350' height='200'></td>";
        echo "<td width='150'><h5>{$row['title']}</h5></td>";
        echo "<td width='150'><h5>{$row['description']}</h5></td>";
        echo "</tr>";
      }
    ?>
    <tbody>
  </table>
  </body>
</html>
