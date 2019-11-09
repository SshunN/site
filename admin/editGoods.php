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
      <h2 class="text-center">Товары</h2>
      <p class="text-center">У нас вы можете приобрести следующие товары</p>
    </div>
    <div class="row projects">
      <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="../resources/goods/Conditioning.jpg" />
        <h3 class="nav-item"><a class="nav-link" href="editConditions.php">Кондиционеры</a></h3>
          <textarea id="condDescr" style="width:350px;height:100px;" onclick="areaClick(this,'description')" onblur="leaveArea(this)">В наличии имеются полупромышленные и промышленные кондиционеры, а так же бытовые спит-системы</textarea>
      </div>
      <div class="col-sm-6 col-lg-4 item"><img class="img-fluid" src="../resources/goods/Ventilation.jpg" />
        <h3 class="nav-item"><a class="nav-link" href="">Вентиляция</a></h3>
          <textarea id="ventDescr" style="width:350px;height:100px;" onclick="areaClick(this,'description')" onblur="leaveArea(this)">Вентиляция промышленных и жилых помещений</textarea>
      </div>
    </div>
  </div>
</div>