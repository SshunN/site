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
    <?php include 'mainHeader.html';?>
      <div class="projects-clean">
        <div class="container">
          <div class="intro">
            <h2 class="text-center">Товары</h2>
            <p class="text-center">У нас вы можете приобрести следующие товары</p>
          </div>
          <div class="row projects">
            <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="resources/goods/Conditioning.jpg" />
              <h3 class="nav-item"><a class="nav-link" href="ConditioningPage.php">Кондиционеры</a></h3>
              <?php
              $cond = fopen("resources/goods/cond/main.txt", "r");
              if ($cond)
              {
                while (!feof($cond))
                {
                  $mytext = fgets($cond, 999);
                  echo "<p>$mytext</p>";
                }
              }
              fclose($cond);
              ?>
            </div>
            <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="resources/goods/Ventilation.jpg" />
                <h3 class="nav-item"><a class="nav-link" href="">Вентиляция</a></h3>
                <p>Вентиляция промышленных и жилых помещений</p>
            </div>
          </div>
        </div>
      </div>
    </body>
</html>
