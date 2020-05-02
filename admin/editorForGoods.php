<?php
  session_start();
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <title>Изменение товара</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/bootstrap.min.css"/>
  <link rel="stylesheet" href="style/navigation.css">
</head>
<body>
  <div class="container">
    <script>
      function check(){
        var file = document.querySelector("#fUpload");
        if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
      }
    </script>
    <form method="post" enctype='multipart/form-data'>
      <?php
      $id = $_SESSION['id'];
      $table = $_SESSION['table'];
      $folder = $_SESSION['folder'];
      $oldImg = [];
      $titleAr = [];
      $descAr = [];
      $priceAr = [];

      $db = new SQLite3('../resources/data.sqlite');
      $sql = "SELECT * FROM $table WHERE id = '$id'";
      $res = $db -> query($sql);
      while ($row = $res->fetchArray()) {
        array_push($oldImg, $row['nameImg']);
        array_push($titleAr, $row['title']);
        array_push($descAr, $row['description']);
        array_push($priceAr, $row['price']);
      }
      $strImg = $oldImg[0];
      $title1 = $titleAr[0];
      $desc1 = $descAr[0];
      $price1 = $priceAr[0];
      ?>
      <p>Выберите файл: <input id="fUpload" type='file' onchange="check()" name="filename" size='10' />
      <textarea id="nameText" name="nameText" ><?php echo htmlspecialchars($title1) ?></textarea>
      <textarea id="descriptionText" name="descriptionText" ><?php echo htmlspecialchars($desc1) ?></textarea>
      <textarea id="priceText" name="priceText" ><?php echo htmlspecialchars($price1) ?></textarea>
      <input type='submit' name="changeGoods" id="changeGoods" value='Изменить' /></p>
      <p>Текущее изображение:</p>
      <p>
      <?php
        echo "<img src='$folder$strImg' width='350' height='200'>";
      ?>
      </p>
      <?php
      function changeGoods($id, $table, $folder)
      {
        $name = $_FILES['filename']['name'];
        $type = pathinfo($name, PATHINFO_EXTENSION);
        $template = $_FILES['filename']['tmp_name'];
          
        $title = $_POST['nameText'];
        $desc = $_POST['descriptionText'];
        $price = $_POST['priceText'];

          if ($_FILES && $_FILES['filename']['error']!= UPLOAD_ERR_OK)
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "UPDATE '$table' SET title = '$title', description = '$desc', price = '$price' WHERE id = '$id'";
            $db -> query($sql);
          }
          if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "UPDATE '$table' SET title = '$title', description = '$desc', nameImg = '$id', price = '$price' WHERE id = '$id'";
            $db -> query($sql);

            echo "$folder.$id";

            move_uploaded_file($template, $folder.$id);
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