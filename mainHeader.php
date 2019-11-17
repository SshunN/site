<div>
  <script>
  class good{
    constructor(id, name, count){
      this.id = id; this.name = name; this.count = count;
    }
    plusCount() { this.count++; }
    getID() { return this.id; }
  }
  var cart={};

  function getCart(){
    var c = localStorage.getItem('cart');
     if(c != null){ cart = JSON.parse(c); }
  }
  getCart();

  function getCartCount(){
    res = 0;
    for(var i in cart) res++;
    var a = document.getElementById("cE");
    a.innerText = "Корзина (" + res + " товара)";
  }
  function addToCart(id, name){
   var count = document.getElementById("count"+id);
   if(cart[id]==undefined) cart[id] = new good(id, name, 0);
   for(i=0;i<count.value;i++)cart[id].plusCount();
   localStorage.setItem('cart', JSON.stringify(cart));
   window.location.href = "ConditioningPage.php";
  }
  </script>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container">
          <a class="navbar-brand" href="main.php">Главная</a>
            <div class="collapse navbar-collapse"
                id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="goodsPage.php">Товары</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="servicePage.php">Услуги</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="about.php">О нас</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="partners.php">Партнёры</a></li>
                    <li class='nav-item' role='presentation'><a id="cE" class='nav-link' onclick="openCart()" href=""></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
    getCartCount();
    function openCart(){
      var a = document.getElementById("cE");
      if(a.innerText != "Корзина (0 товара)")
      {
        document.cookie = "cart=" + JSON.stringify(cart);
        a.href ="CartPage.php";
      }
      else a.href ="";
    }
    </script>
</div>
