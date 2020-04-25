  <div class="container">
    <script>
      function check(){
        var file = document.querySelector("#fUpload");
        if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
      }
    </script>
    <form method="post" enctype='multipart/form-data'>
      <?php
        require 'classComponents.php';

        $dbObj = new DbModul;

        $id = $_SESSION['id'];
        $table = $_SESSION['table'];
        $folder = $_SESSION['folder'];

        $db = new SQLite3('../resources/data.sqlite');
        $sql = "SELECT * FROM $table WHERE id = '$id'";
        $res = $db -> query($sql);
        while ($row = $res->fetchArray()) {
          $strImg = $row['nameImg'];
          $title1 = $row['title'];
          $desc1 = $row['description'];
          if ($table == "Goods")
          { $price1 = $row['price']; }
        }
      ?>
      <p>Выберите файл: <input id="fUpload" type='file' onchange="check()" name="filename" size='10' />
      <textarea id="nameText" name="nameText" ><?php echo htmlspecialchars($title1) ?></textarea>
      <textarea id="descriptionText" name="descriptionText" ><?php echo htmlspecialchars($desc1) ?></textarea>
      <?php
        if ($table == "Goods")
          { 
            echo '<textarea id="priceText" name="priceText">';
            echo htmlspecialchars($price1);
            echo '</textarea>';
          }

        echo "<input type='submit' name='changeGoods' id='changeGoods' value='Изменить' /></p>
              <p>Текущее изображение:</p>
              <p><img src='$folder$strImg' width='350' height='200'></p>";

        if (isset($_POST['changeGoods']))
        {
          $id = $_SESSION['id'];
          $table = $_SESSION['table'];
          $folder = $_SESSION['folder'];
          $backPath = $_SESSION['backPath'];
  		    $dbObj -> changeGoods($id, $table, $folder);
          echo "<script>document.location.href='$backPath'</script>";
          exit();
        }
      ?>
    </form>
  </div>