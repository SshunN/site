<?php
  session_start();
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <title>Добавление кондиционеров</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/bootstrap.min.css"/>
  <link rel="stylesheet" href="style/navigation.css">
</head>
<body>
  <div class="container">
    <script>
      function clickArea(id, startText){
        var area = document.getElementById(id);
        if(area.innerHTML == startText) area.innerHTML = '';
      }
      function liveArea(id, text){
        var area = document.getElementById(id);
        if(area.innerHTML == '') area.innerHTML = text;
      }
      function check(){
        var file = document.querySelector("#fUpload");
        if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
      }
    </script>
    <form method="post" enctype='multipart/form-data'>
      <p>Выберите файл: <input id="fUpload" type='file' onchange="check()" name="filename" size='10' />
      <textarea id="nameText" name="nameText" onclick="clickArea('nameText', 'Наименование')" onblur="liveArea('nameText', 'Наименование')">Наименование</textarea>
      <textarea id="descriptionText" name="descriptionText" onclick="clickArea('descriptionText', 'Описание')" onblur="liveArea('descriptionText', 'Описание')">Описание</textarea>
      <input type='submit' name="addButton" id="addButton" value='Добавить товар' /></p>

      <?php
      $folder = "../resources/goods/cond/";
      function addNew($folder)
      {
        $title = $_POST['nameText'];
        $desc = $_POST['descriptionText'];
        if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK && $title!= 'Наименование' && $desc!= 'Описание')
        {
          $name = $_FILES['filename']['name'];
          $type = pathinfo($name, PATHINFO_EXTENSION);
          $id_base = 0;
          $template = $_FILES['filename']['tmp_name'];

          $db = new SQLite3('../resources/data.sqlite');
          $res = $db->query('SELECT id FROM Services');
          while ($row = $res->fetchArray()) {
            if ($id_base < $row['id'])
            {
              $id_base = $row['id'];
            }
          }
          $id_img = $id_base + 1;

          if($type == "jpg" | $type == "jpeg" | $type == "png")
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "INSERT INTO Services (title, description, nameImg) VALUES ('$title', '$desc', '$id_img')";
            $db -> query($sql);
            move_uploaded_file($template, $folder.$id_img);
          }
          else echo "Файл не был загружен";
          unset($_FILES['filename']);
        }
      }
      function deleteGoods($id)
      {
        $db = new SQLite3('../resources/data.sqlite');
        $sql = "DELETE FROM Services WHERE id = '$id'";
        $db -> query($sql);
      }
      if (isset($_POST['addButton']))
      { 
        addNew($folder);  
        echo('<meta http-equiv="refresh" content="0">');
        exit(); 
        
      }
      if (isset($_POST['deleteGoods']))
      {
        $id = key($_POST['deleteGoods']);
        deleteGoods($id);
        echo('<meta http-equiv="refresh" content="0">');
        exit();
      }
      if (isset($_POST['changeGoods']))
      {
        $_SESSION['id'] = key($_POST['changeGoods']);
        $_SESSION['table'] = "Services";
        $_SESSION['folder'] = $folder;
        $_SESSION['backPath'] = "../admin/editConditions.php";
        echo '<script>document.location.href="../admin/editor.php"</script>';
        exit();
      }
        $db = new SQLite3('../resources/data.sqlite');
        $res = $db->query('SELECT * FROM Services');

        echo "<p>Текущие товары</p>";
        while ($row = $res->fetchArray()) {
          $i = $row['nameImg'];
          $id = $row['id'];
          echo "<table>";
          echo "<tr>";
          echo "<td width='400'><img src='$folder$i' width='350' height='200'></td>";
          echo "<td width='150'><h5>{$row['title']}</h5></td>";
          echo "<td width='150'><h5>{$row['description']}</h5></td>";
          echo "<td width='300'>
          <form method='post' action=''>
          <input type='submit' name='changeGoods[$id]' value='Изменить'></button>
          <input type='submit' name='deleteGoods[$id]' value='Удалить'></button>
          </form>
          </td>";
          echo "</tr>";
          echo "</table>";
        }
      ?>
    </form>
  </div>
</body>
</html>