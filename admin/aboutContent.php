    <script>
      var oldText;
      function areaClick(area, type)
      {
        switch (type) {
          case 'description':
            oldText = area.value;
            break;
          default: break;
        }
      }
      function leaveArea(area)
      {
        if(area.value != oldText)
        {
          alert("change");
          //сохранение
        }
      }
    </script>

    <div class="projects-clean">
    	<div class="container">
        	<div class="intro">
          		<h2 class="text-center">Редактирование данных компании</h2>
        	</div>
        	<div>
        		<?php
              require 'classComponents.php';

              $abObj = new About;

        			$file = $abObj -> getFile();

        			if (isset($_POST['text']))
					{
						file_put_contents($file, $_POST['text']); //
						echo('<meta http-equiv="refresh" content="0">');
        				exit(); 
					}
					$text = file_get_contents($file); //
        		?>
        		<form action="" method="post">
				<textarea autofocus name="text" style="width: 1100px; height: 500px; resize: none;"><?php echo htmlspecialchars($text) ?></textarea>
				<p><input type="submit" value="Сохранить изменения" /></p>
				</form>
        	</div>
		</div>
    </div>