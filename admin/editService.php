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
    <?php include 'editHeader.html'; ?>
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
          <h2 class="text-center">Категории сервисов</h2>
          <p class="text-center">Выберите изменяемую категорию</p>
        </div>
              <div class="row projects">
                  <div class="col-sm-6 item">
                      <div class="row">
                          <div class="col-md-12 col-lg-5"><img class="img-fluid" src="../resources/air.png" /></a></div>
                          <div class="col">
                              <h3 class="name">Установка кондиционеров</h3>
                              <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 item">
                      <div class="row">
                          <div class="col-md-12 col-lg-5"><img class="img-fluid" src="../resources/video.jpg" /></a></div>
                          <div class="col">
                              <h3 class="name">Установка систем видеонаблюдений</h3>
                              <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm-6 item">
                      <div class="row">
                          <div class="col-md-12 col-lg-5"><img class="img-fluid" src="../resources/gaz.jpg" /></a></div>
                          <div class="col">
                              <h3 class="name">Прочие услуги</h3>
                              <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida.</p>
                          </div>
                      </div>
                  </div>
              </div>
      </div>
    </div>
  </body>
</html>