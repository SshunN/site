<?php
      function addNew($folder, $file, $nameText, $descriptionText, $table)
      {
        $title = $_POST[$nameText];
        $desc = $_POST[$descriptionText];
        if ($title!= '')
        {
          $name = $_FILES[$file]['name'];
          $type = pathinfo($name, PATHINFO_EXTENSION);
          $id_base = 0;
          $template = $_FILES[$file]['tmp_name'];

          $db = new SQLite3('../resources/data.sqlite');
          $res = $db->query("SELECT id FROM '$table'");
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
            $sql = "INSERT INTO $table (title, description, nameImg) VALUES ('$title', '$desc', '$id_img')";
            $db -> query($sql);
            move_uploaded_file($template, $folder.$id_img);
          }
          if($type == "")
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "INSERT INTO $table (title, description) VALUES ('$title', '$desc')";
            $db -> query($sql);  
          }
          else echo "Файл не был загружен";
          unset($_FILES[$file]);
        }
      }

      function deleteGoods($id, $table)
      {
        $db = new SQLite3('../resources/data.sqlite');
        $sql = "DELETE FROM '$table' WHERE id = '$id'";
        $db -> query($sql);
        $db->close();
      }

      function deleteRecord($categoryID, $table)
      {
        $db = new SQLite3('../resources/data.sqlite');
        $sql = "DELETE FROM '$table' WHERE categoryID = '$categoryID'";
        $db -> query($sql);
        $db->close();
      }

      function addNew1($folder, $file, $nameText, $descriptionText, $price, $table, $catID)
      {
        $title = $_POST[$nameText];
        $desc = $_POST[$descriptionText];
        $price = $_POST[$price];
        if ($title!= '')
        {
          $name = $_FILES[$file]['name'];
          $type = pathinfo($name, PATHINFO_EXTENSION);
          $id_base = 0;
          $template = $_FILES[$file]['tmp_name'];

          $db = new SQLite3('../resources/data.sqlite');
          $res = $db->query("SELECT id FROM '$table'");
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
            $sql = "INSERT INTO $table (categoryID, title, description, nameImg, price) VALUES ('$catID', '$title', '$desc', '$id_img', '$price')";
            $db -> query($sql);
            move_uploaded_file($template, $folder.$id_img);
          }
          if($type == "")
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "INSERT INTO $table (categoryID, title, description, price) VALUES ('$catID','$title', '$desc', '$price')";
            $db -> query($sql);  
          }
          else echo "Файл не был загружен";
          unset($_FILES[$file]);
        }
      }
?>