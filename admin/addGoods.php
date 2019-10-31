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
    <div>
        <div class="container">
            <div>
              <script>
              function clickArea(id, startText){
                var area = document.getElementById(id);
                if(area.innerHTML == startText) area.innerHTML = '';
              }
              function liveArea(id, text){
                var area = document.getElementById(id);
                if(area.innerHTML == '') area.innerHTML = text;
              }
              </script>
              <br/>

            <?php
            function addNew()
            {
              if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
              {
                  $name = $_FILES['filename']['name'];
                  $type = pathinfo($name, PATHINFO_EXTENSION);;
                  if($type == "jpg" | $type == "jpeg" | $type == "png")
                  {
                    $db = new SQLite3('resources/db/data.sqlite');
                    $db->exec("insert into Services(title, description) values('title', 'desc')");
                    // move_uploaded_file($_FILES['filename']['tmp_name'], "resources/$name");
                    // echo "Файл загружен";
                    // $name = null;
                    // $type = null;
                  }
                  else echo "Файл не был загружен";
                  unset($_FILES['filename']);
              }
            }
            if(array_key_exists('test',$_POST)){ addNew();  exit(); }
            ?>
            <script>
              function check(){
                var file = document.querySelector("#fUpload");
                if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
              }
            </script>
            <form method="post" enctype='multipart/form-data'>
              <textarea id="nameText" onclick="clickArea('nameText', 'name')" onblur="liveArea('nameText', 'name')">name</textarea><br/>
              <textarea id="descriptionText" onclick="clickArea('descriptionText', 'description')" onblur="liveArea('descriptionText', 'description')">description</textarea><br/>
            Выберите файл: <input id="fUpload" type='file' onchange="check()" name='filename' size='10' /><br /><br />
            <input type='submit' name="test" id="test" value='Загрузить' />
            </form>
            </div>
        </div>
    </div>
</body>
</html>
