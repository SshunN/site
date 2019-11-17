<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Товары</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
  </head>
  <body>
    <?php include 'mainHeader.php';?>
      <div class="projects-clean">
        <div class="container">
          <div class="intro">
            <h2 class="text-center">Товары</h2>
            <p class="text-center">У нас вы можете приобрести следующие товары</p>
          </div>
          <div class="row projects">
            <div class="col-sm-6 col-lg-4 item">
              <img class="img-fluid" style="width:400px;height:200px;" src="resources/goods/Conditioning.jpg" />
              <h3 class="nav-item"><a class="nav-link" href="ConditioningPage.php">Кондиционеры</a></h3>
              <?php echo rFile('resources/goods/cond/main.txt');?>
            </div>
            <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" style="width:400px;height:200px;" src="resources/goods/Ventilation.jpg" />
                <h3 class="nav-item"><a class="nav-link" href="">Вентиляция</a></h3>
                <?php echo rFile('resources/goods/vent/main.txt');?>
            </div>
            <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" style="width:400px;height:200px;" src="resources/goods/Heating.jpg" />
                <h3 class="nav-item"><a class="nav-link" href="">Отопление</a></h3>
                <?php echo rFile('resources/goods/heating/main.txt');?>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>

<?php
function rFile($dir)
{
  $string = "";
  $fp = fopen($dir, "r");
  if ($fp) { while (!feof($fp)) { $string = fgets($fp, 999); } }
  fclose($fp);
  return "<p>$string</p>";
}
?>
