<?php
	class Components {

		private $id;
		private $title;
		private $description;
		private $image;

		public function setID($_id)
		{ $this -> id = $_id; }
		public function setTitle($_title)
		{ $this -> title = $_title; }
		public function setDesc($_desc)
		{ $this -> description = $_desc; }
		public function setImage($_img)
		{ $this -> image = $_img; }

		public function getID()
		{ return $this -> id; }
		public function getTitle()
		{ return $this -> title; }
		public function getDesc()
		{ return $this -> description; }
		public function getImage()
		{ return $this -> image; }
	}

	class Category {

		private $link;

		public function setLink($_link)
		{ $this -> link = $_link; }

		public function getLink()
		{ return $this -> link; }
	}

	class GoodPrice { //goodService

		private $price;

		public function setPrice($_price)
		{ $this -> price = $_price; }

		public function getPrice()
		{ return $this -> price; }
	}

	class News {

		private $data;

		function __construct()
		{ $this -> data = date(" H : i : s d - m - Y "); } 

		public function getData()
		{ return $this -> data; }		
	}

	class About {

		private $file;
		
		function __construct()
		{ $this -> file = '../resources/mainPage.txt'; }

		public function getFile()
		{ return $this -> file; }			
	}

	class DbModul {

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

      function addNew2($folder, $file, $nameText, $descriptionText, $data, $table)
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
            $sql = "INSERT INTO $table (title, description, nameImg, data) VALUES ('$title', '$desc', '$id_img', '$data')";
            $db -> query($sql);
            move_uploaded_file($template, $folder.$id_img);
          }
          if($type == "")
          {
            $db = new SQLite3('../resources/data.sqlite');
            $sql = "INSERT INTO $table (title, description, data) VALUES ('$title', '$desc', '$data')";
            $db -> query($sql);  
          }
          else echo "Файл не был загружен";
          unset($_FILES[$file]);
        }
      }

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
            if ($table == "Goods")
              { $sql = "UPDATE '$table' SET title = '$title', description = '$desc', price = '$price' WHERE id = '$id'"; }
            else
              { $sql = "UPDATE '$table' SET title = '$title', description = '$desc' WHERE id = '$id'"; }
            $db -> query($sql);
          }
          if ($_FILES && $_FILES['filename']['error']== UPLOAD_ERR_OK)
          {
            $db = new SQLite3('../resources/data.sqlite');
            if ($table == "Goods")
              { $sql = "UPDATE '$table' SET title = '$title', description = '$desc', nameImg = '$id', price = '$price' WHERE id = '$id'"; }
            else
              { $sql = "UPDATE '$table' SET title = '$title', description = '$desc', nameImg = '$id' WHERE id = '$id'"; }
            $db -> query($sql);

            move_uploaded_file($template, $folder.$id);
          }
      }
	}
?>