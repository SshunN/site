<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <title>Добавление товаров</title>
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
      <textarea id="nameText" name="nameText" onclick="clickArea('nameText', 'Наименование')" onblur="liveArea('nameText', 'Наименование')">Наименование</textarea><br/>
      <textarea id="descriptionText" name="descriptionText" onclick="clickArea('descriptionText', 'Описание')" onblur="liveArea('descriptionText', 'Описание')">Описание</textarea><br/>
            Выберите файл: <input id="fUpload" type='file' onchange="check()" name="filename" size='10' /><br /><br />
      <p><input type='submit' name="test" id="test" value='Добавить товар' /></p>
      <p><select id="Goods" name="Goods">
        <option value="" disabled selected>Выберите номер товара</option>
        <?php
          $db = new SQLite3('../resources/data.sqlite');
          $res = $db->query('SELECT id FROM Services');
          while ($row = $res->fetchArray()) {
            echo "<option>{$row['id']}</option>";
          }
        ?>
      </select>
      для того, чтобы <input type='submit' name="deleteGoods" id="deleteGoods" value='Удалить товар' />
      или <input type='submit' name="changeGoods" id="changeGoods" value='Изменить' /> его</p>
      <?php
      function addNew()
      {
        $title = $_POST['nameText'];
        $desc = $_POST['descriptionText'];
        if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK && $title!= 'Наименование' && $desc!= 'Описание')
        {
          $name = $_FILES['filename']['name'];
          $type = pathinfo($name, PATHINFO_EXTENSION);

          $id_base = 0;
          $folder = "../resources/";
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

          move_uploaded_file($template, $folder.$id_img);

          if($type == "jpg" | $type == "jpeg" | $type == "png")
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "INSERT INTO Services (title, description, nameImg) VALUES ('$title', '$desc', '$id_img')";
            $db -> query($sql);
          }
          else echo "Файл не был загружен";
          unset($_FILES['filename']);
        }
      }
      function deleteGoods()
      {
        $selectedId = $_POST['Goods'];
        $db = new SQLite3('../resources/data.sqlite');
        $sql = "DELETE FROM Services WHERE id = '$selectedId'";
        $db -> query($sql);
      }
      function changeGoods()
      {
        $name = $_FILES['filename']['name'];
        $type = pathinfo($name, PATHINFO_EXTENSION);
        $folder = "../resources/";
        $template = $_FILES['filename']['tmp_name'];
          
        $selectedId = $_POST['Goods'];
        $title = $_POST['nameText'];
        $desc = $_POST['descriptionText'];
        $oldImg = [];

        $db = new SQLite3('../resources/data.sqlite');
        $sql = "SELECT * FROM Services WHERE id = '$selectedId'";
        $res = $db -> query($sql);
        while ($row = $res->fetchArray()) {
          array_push($oldImg, $row['nameImg']);
        }
        $strImg = $oldImg[0];

        if ($selectedId!= null)
        {
          if (($title!= 'Наименование' || $desc!= 'Описание') && $_FILES && $_FILES['filename']['error']!= UPLOAD_ERR_OK)
          {
            if ($title == 'Наименование')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE Services SET description = '$desc' WHERE id = '$selectedId'";
                $db -> query($sql);
              }
            if ($desc == 'Описание')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE Services SET title = '$title' WHERE id = '$selectedId'";
                $db -> query($sql);
              }
            if ($title != 'Наименование' && $desc != 'Описание')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE Services SET title = '$title', description = '$desc' WHERE id = '$selectedId'";
                $db -> query($sql);
              }
          }
          if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
          {
            if ($title == 'Наименование' && $desc != 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE Services SET description = '$desc', nameImg = '$selectedId' WHERE id = '$selectedId'";
              $db -> query($sql);

              unlink('../resources/$selectedId');
              move_uploaded_file($template, $folder.$selectedId);
            }
            if ($desc == 'Описание' && $title != 'Наименование')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE Services SET title = '$title', nameImg = '$selectedId' WHERE id = '$selectedId'";
              $db -> query($sql);

              unlink('../resources/$selectedId');
              move_uploaded_file($template, $folder.$selectedId);
            }
            if ($title != 'Наименование' && $desc != 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE Services SET title = '$title', description = '$desc', nameImg = '$selectedId' WHERE id = '$selectedId'";
              $db -> query($sql);

              unlink('../resources/$selectedId');
              move_uploaded_file($template, $folder.$selectedId);
            }
            if ($title == 'Наименование' && $desc == 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE Services SET nameImg = '$selectedId' WHERE id = '$selectedId'";
              $db -> query($sql);

              unlink("../resources/$selectedId");
              move_uploaded_file($template, $folder.$selectedId);
            }
          }
        }
      }
      if (isset($_POST['test']))
      { 
        addNew();  
        echo('<meta http-equiv="refresh" content="0">');
        exit(); 
        
      }
      if (isset($_POST['deleteGoods']))
      {
        deleteGoods();
        echo('<meta http-equiv="refresh" content="0">');
        exit();
      }
      if (isset($_POST['changeGoods']))
      {
        changeGoods();
        echo('<meta http-equiv="refresh" content="0">');
        exit();
      }
        $db = new SQLite3('../resources/data.sqlite');
        $res = $db->query('SELECT * FROM Services');

        echo "<p>Текущие товары</p>";
        while ($row = $res->fetchArray()) {
          echo "<div>";
          echo "<p>{$row['id']}) Наименование: {$row['title']}</p>";
          echo "<p>Описание: {$row['description']}</p>";
          echo "<p><img class='img-fluid' src='../resources/{$row['nameImg']}' /></p>";
          echo "</div>";
        }
      ?>
    </form>
  </div>
</body>
</html>