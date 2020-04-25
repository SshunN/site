    <script>
      function check(){
        var file = document.querySelector("#fUpload");
        if ( /\.(jpe?g|png)$/i.test(file.files[0].name) === false ) { alert("Выберите корректный файл!"); }
      }
    </script>
    <div>
      <form method='post' enctype='multipart/form-data'>
      <?php
        require 'classComponents.php';

        $catID = $_GET['category'];

        $folder = $_SESSION['folder'];
        
        $cmpObj = new Components;
        $catObj = new Category;
        $priObj = new GoodPrice;
        $dbObj = new DbModul;
        $neObj = new News;

        $db = new SQLite3('../resources/data.sqlite');
        if (is_null($catID))
          {
            $table = $_SESSION['table'];
            $res = $db->query("SELECT * FROM '$table'");
          }
        else  
        {
          $_SESSION['table'] = 'Goods';
          $table = $_SESSION['table'];
          $res = $db->query("SELECT * FROM '$table' WHERE categoryID='$catID'");
        }
        echo "<p>Перечень</p>";
        echo "<div>";
        echo "<table>";
        echo "<tr><p>Добавить</p></tr>";
        echo "<tr>";
        echo "<td width='400'><p>Выберите файл:</p><input id='fUpload' type='file' onchange='check()' name='filename' size='10' /></td>";
        echo "<td width='150'><textarea id='nameText' name='nameText' placeholder='Наименование'></textarea></td>";
        echo "<td width='150'><textarea id='descriptionText' name='descriptionText' placeholder='Описание'></textarea></td>";
        if (is_null($catID) == 0)
        {
          echo "<td width='150'><textarea id='priceText' name='priceText' placeholder='Цена'></textarea></td>";
        }
        echo "<td width='300'><input type='submit' name='addButton' id='addButton' value='Добавить'></button></td>";
        echo "</tr>";
        
        while ($row = $res->fetchArray()) {

          $cmpObj -> setID($row['id']);
          $cmpObj -> setTitle($row['title']);
          $cmpObj -> setDesc($row['description']);
          $cmpObj -> setImage($row['nameImg']);

          if (is_null($catID) == 0)
          { $priObj -> setPrice($row['price']); }
          echo "<tr>";
          $image = $cmpObj -> getImage();
          echo "<td width='400'><img src='$folder$image' width='350' height='200'></td>";
          if ($table == "GoodsCategory")
            { 
              $catObj -> setLink($cmpObj -> getID());
              echo "<td width='150'><h5><a href= 'goodsPage.php?category={$catObj -> getLink()}'>{$cmpObj -> getTitle()}</a></h5></td>"; }
          else
            { echo "<td width='150'><h5>{$cmpObj -> getTitle()}</h5></td>"; }
          echo "<td width='150'><h5>{$cmpObj -> getDesc()}</h5></td>";
          if (is_null($catID) == 0)
          {
            echo "<td width='150'><h5>{$priObj -> getPrice()}</h5></td>";
          }
          if ($table == "News")
            { 
              $data = $row['data'];
              echo "<td width='150'><h5>{$data}</h5></td>"; 
            }
          echo "<td width='300'>
          <input type='submit' name='changeGoods[{$cmpObj -> getID()}]' value='Изменить'></button>
          <input type='submit' name='deleteGoods[{$cmpObj -> getID()}]' value='Удалить'></button>
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
          if (is_null($catID) == 0)
          {
            $price = "priceText";
            $dbObj -> addNew1($folder, $file, $nameText, $descriptionText, $price, $table, $catID);
          }
          elseif ($table == "News")
          {
            $date = $neObj -> getData();
            $dbObj -> addNew2($folder, $file, $nameText, $descriptionText, $date, $table);
          }
          else
          { addNew($folder, $file, $nameText, $descriptionText, $table); }  

          echo('<meta http-equiv="refresh" content="0">');
          exit(); 
        }
        if (isset($_POST['deleteGoods']))
        {
          $id = key($_POST['deleteGoods']);
          if ($table == "GoodsCategory")
          {
            $table0 = "Goods";
            $dbObj -> deleteRecord($id, $table0); 
          }
          $dbObj -> deleteGoods($id, $table);
          echo('<meta http-equiv="refresh" content="0">');
          exit();
        }
        if (isset($_POST['changeGoods']))
        {
          $_SESSION['id'] = key($_POST['changeGoods']);
          if (is_null($catID) == 0)
            { $_SESSION['backPath'] = "../admin/goodsPage.php?category={$catObj -> getLink()}"; }
          echo '<script>document.location.href="../admin/changePage.php"</script>'; 
          exit();
        }
      ?>
    </div>
  </form>