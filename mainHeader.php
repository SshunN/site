<?php
  require_once('PageGenerator.php');
  function drawHeader($currentPage) 
  {
    echo "
    <script>
    class good
  {
    constructor(id, name, count){this.id = id; this.name = name; this.count = count; }
    plusCount() { this.count++; }
  }
var cart={};
function getCart(){var c = localStorage.getItem('cart');if(c != null){ cart = JSON.parse(c); }}
  function changePage(id)
  {
    var last = document.getElementsByClassName('navbar-brand')[0];
    var item = document.getElementById(id);
    if(item && last != item){last.className = 'nav-link';item.className = 'navbar-brand';}
  }
  function getCartCount(){
    res = 0;
    for(var i in cart) res++;
    var a = document.getElementById('cartH');
    a.innerText = 'Корзина (' + res + ' товара)';
  }
  function addToCart(id, name, catID){
   var count = document.getElementById('count'+id);
   if(cart[id]==undefined) cart[id] = new good(id, name, 0);
   for(i=0;i<count.value;i++)cart[id].plusCount();
   localStorage.setItem('cart', JSON.stringify(cart));
   window.location.href = 'PageGenerator.php?category=' + catID;
  }
  function openCart(){
    var a = document.getElementById('cartH');
    if(a.innerText != 'Корзина (0 товара)') 
    { document.cookie = 'cart=' + JSON.stringify(cart);a.href ='CartPage.php'; }
    else a.href ='';
  }</script>";
    setHeader(array(new HeaderItem("mainH", "index.php", "Главная"), new HeaderItem("goodH", "goodsPage.php", "Товары"), new HeaderItem("serviceH", "servicePage.php", "Услуги"),
      new HeaderItem("aboutH", "about.php", "О нас"), new HeaderItem("partsH", "partners.php", "Партнёры"),
      new HeaderItem("cartH", "", "", "openCart()")), $currentPage, true);
      echo "
      <script>
  getCartCount();
  getCart();
</script>
      ";
  }
?>