<?php
  session_start();
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <title>Изменение товапа</title>
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
      <p><input type='submit' name="changeGoods" id="changeGoods" value='Изменить' /></p>

      <?php
      function changeGoods($id, $table, $folder)
      {
        $name = $_FILES['filename']['name'];
        $type = pathinfo($name, PATHINFO_EXTENSION);
        $template = $_FILES['filename']['tmp_name'];
          
        $title = $_POST['nameText'];
        $desc = $_POST['descriptionText'];
        $oldImg = [];

        $db = new SQLite3('../resources/data.sqlite');
        $sql = "SELECT * FROM $table WHERE id = '$id'";
        $res = $db -> query($sql);
        while ($row = $res->fetchArray()) {
          array_push($oldImg, $row['nameImg']);
        }
        $strImg = $oldImg[0];

        if ($id!= null)
        {
          if (($title!= 'Наименование' || $desc!= 'Описание') && $_FILES && $_FILES['filename']['error']!= UPLOAD_ERR_OK)
          {
            if ($title == 'Наименование')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE $table SET description = '$desc' WHERE id = '$id'";
                $db -> query($sql);
              }
            if ($desc == 'Описание')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE $table SET title = '$title' WHERE id = '$id'";
                $db -> query($sql);
              }
            if ($title != 'Наименование' && $desc != 'Описание')
              {
                $db = new SQLite3('../resources/data.sqlite');
                $sql = "UPDATE $table SET title = '$title', description = '$desc' WHERE id = '$id'";
                $db -> query($sql);
              }
          }
          if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
          {
            if ($title == 'Наименование' && $desc != 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE $table SET description = '$desc', nameImg = '$id' WHERE id = '$id'";
              $db -> query($sql);

              move_uploaded_file($template, $folder.$id);
            }
            if ($desc == 'Описание' && $title != 'Наименование')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE $table SET title = '$title', nameImg = '$id' WHERE id = '$id'";
              $db -> query($sql);

              move_uploaded_file($template, $folder.$id);
            }
            if ($title != 'Наименование' && $desc != 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE $table SET title = '$title', description = '$desc', nameImg = '$id' WHERE id = '$id'";
              $db -> query($sql);
;
              move_uploaded_file($template, $folder.$id);
            }
            if ($title == 'Наименование' && $desc == 'Описание')
            {
              $db = new SQLite3('../resources/data.sqlite');
              $sql = "UPDATE $table SET nameImg = '$id' WHERE id = '$id'";
              $db -> query($sql);

              move_uploaded_file($template, $folder.$id);
            }
          }
        }
      }
      if (isset($_POST['changeGoods']))
      {
		    $id = $_SESSION['id'];
		    $table = $_SESSION['table'];
        $folder = $_SESSION['folder'];
        $backPath = $_SESSION['backPath'];
		    changeGoods($id, $table, $folder);
        echo "<script>document.location.href='$backPath'</script>";
        exit();
      }
      ?>
    </form>
  </div>
</body>
</html>