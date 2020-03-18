  <body>
    <?php 
      include_once 'mainHeader.php';
      setHeadInfo("Услуги");
      addStylesArray(array("style/bootstrap.min.css", "style/navigation.css"));
      inicializeHead();
      drawHeader("serviceH");
    ?>
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
