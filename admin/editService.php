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
        $res = $db->query('SELECT * FROM Services');
        echo "<p>Категории услуг</p>";
        echo "<div>";
        echo "<table>";
        echo "<tr><p>Добавить категорию</p></tr>";
        echo "<tr>";
        echo "<td width='400'><p>Выберите файл:</p><input id='fUpload1' type='file' onchange='check()' name='filename1' size='10' /></td>";
        echo "<td width='150'><textarea id='nameText1' name='nameText1' placeholder='Наименование'></textarea></td>";
        echo "<td width='150'><textarea id='descriptionText1' name='descriptionText1' placeholder='Описание'></textarea></td>";
        echo "<td width='300'><input type='submit' name='addButton1' id='addButton1' value='Добавить услугу'></button></td>";
        echo "</tr>";
        while ($row = $res->fetchArray()) {
          $image1 = $row['nameImg'];
          $title1 = $row['title'];
          $id1 = $row['id'];
          $desc1 = $row['description'];
          $folder1 = "../resources/services/";

          echo "<tr>";
          echo "<td width='400'><img src='$folder1$image1' width='350' height='200'></td>";
          echo "<td width='150'><h5>{$title1}</h5></td>";
          echo "<td width='150'><h5>{$desc1}</h5></td>";
          echo "<td width='300'>
          <input type='submit' name='changeGoods1[$id1]' value='Изменить'></button>
          <input type='submit' name='deleteGoods1[$id1]' value='Удалить'></button>
          </td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

        if (isset($_POST['addButton1']))
        { 
          $file = "filename1";
          $nameText = "nameText1";
          $descriptionText = "descriptionText1";
          $table = "Services";
          $folder = "../resources/services/";
          addNew($folder, $file, $nameText, $descriptionText, $table);  

          echo('<meta http-equiv="refresh" content="0">');
          exit(); 
        }
        if (isset($_POST['deleteGoods1']))
        {
          $table = "Services";
          $id = key($_POST['deleteGoods1']);
          deleteGoods($id, $table);
          echo('<meta http-equiv="refresh" content="0">');
          exit();
        }
        if (isset($_POST['changeGoods1']))
        {
          $_SESSION['id'] = key($_POST['changeGoods1']);
          $_SESSION['table'] = "Services";
          $_SESSION['folder'] = $folder1;
          $_SESSION['backPath'] = "../admin/editService.php";
          echo '<script>document.location.href="../admin/editor.php"</script>';
          exit();
        }
      ?>
    </div>
  </form>
  </body>
</html>