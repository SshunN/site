<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Услуги</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/bootstrap.min.css"/>
    <link rel="stylesheet" href="style/navigation.css">
  </head>
  <body>
    <?php include 'mainHeader.php';?>
    <script>changePage("serviceH");</script>
    <div>
        <div class="container" id="Cont0">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </div>
      <div class="projects-horizontal">
          <div class="container">
              <div class="intro">
                  <h2 class="text-center">Услуги</h2>
                  <p class="text-center">Мы предоставляем ряд услуг, представленные на данной странице.</p>
              </div>
              <?php
                $db = new SQLite3('resources/data.sqlite');
                $res = $db->query("SELECT * FROM Services");
                echo "<div class='row projects'><div class='col-sm-6 item'>";
                while ($row = $res->fetchArray()) {
                    $name = $row['title'];
                    $desc = $row['description'];
                    echo "<div class='row'><div class='col'>";
                    echo "<h3 class='name'>$name</h3>";
                    echo "<p class='description'>$desc</p></div></div>";
                }
                echo "</div></div>"
              ?>
          </div>
      </div>
  </body>
</html>
