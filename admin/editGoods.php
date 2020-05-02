<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Товары</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
  </head>
  <body>
    <?php include 'editHeader.html'; ?>
    <script>
      function check(){
        var file = document.querySelector("#fUpload");
        if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
      }
    </script>
    <div>
      <form method='post' enctype='multipart/form-data'>
      <?php
        require 'funcToChange.php';

        $db = new SQLite3('../resources/data.sqlite');
        $res = $db->query('SELECT * FROM GoodsCategory');
        echo "<p>Категории товаров</p>";
        echo "<div>";
        echo "<table>";
        echo "<tr><p>Добавить категорию</p></tr>";
        echo "<tr>";
        echo "<td width='400'><p>Выберите файл:</p><input id='fUpload' type='file' onchange='check()' name='filename' size='10' /></td>";
        echo "<td width='150'><textarea id='nameText' name='nameText' placeholder='Наименование'></textarea></td>";
        echo "<td width='150'><textarea id='descriptionText' name='descriptionText' placeholder='Описание'></textarea></td>";
        echo "<td width='300'><input type='submit' name='addButton' id='addButton' value='Добавить товар'></button></td>";
        echo "</tr>";
        $folder = "../resources/goods/cond/";
        while ($row = $res->fetchArray()) {
          $image = $row['nameImg'];
          $title = $row['title'];
          $id = $row['id'];
          $desc = $row['description'];
          echo "<tr>";
          echo "<td width='400'><img src='$folder$image' width='350' height='200'></td>";
          echo "<td width='150'><h5><a href='generator.php?category=$id'>$title</a></h5></td>";
          echo "<td width='150'><h5>{$desc}</h5></td>";
          echo "<td width='300'>
          <input type='submit' name='changeGoods[$id]' value='Изменить'></button>
          <input type='submit' name='deleteGoods[$id]' value='Удалить'></button>
          </td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

        if (isset($_POST['addButton']))
        { 
          $file = "filename";
          $nameText = "nameText";
          $descriptionText = "descriptionText";
          $table = "GoodsCategory";
          addNew($folder, $file, $nameText, $descriptionText, $table);

          echo('<meta http-equiv="refresh" content="0">');
          exit(); 
        }
        if (isset($_POST['deleteGoods']))
        {
          $id = key($_POST['deleteGoods']);
          $table = "GoodsCategory";
          $table0 = "Goods";
          deleteRecord($id, $table0);     
          deleteGoods($id, $table);
          echo('<meta http-equiv="refresh" content="0">');
          exit();
        }
        if (isset($_POST['changeGoods']))
        {
          $_SESSION['id'] = key($_POST['changeGoods']);
          $_SESSION['table'] = "GoodsCategory";
          $_SESSION['folder'] = $folder;
          $_SESSION['backPath'] = "../admin/editGoods.php";
          echo '<script>document.location.href="../admin/editor.php"</script>';
          exit();
        }
      ?>
    </form>
    </div>
  </body>
</html>