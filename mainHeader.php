<?php
  require_once('PageGenerator.php');
  function drawHeader($currentPage) 
  {
    setHeader(array(new HeaderItem("mainH", "index.php", "Главная"), new HeaderItem("goodH", "goodsPage.php", "Товары"), new HeaderItem("serviceH", "servicePage.php", "Услуги"),
      new HeaderItem("aboutH", "about.php", "О нас"), new HeaderItem("partsH", "partners.php", "Партнёры"),
      new HeaderItem("cartH", "", "", "openCart()")), $currentPage, true);
    echo "
    <script>
    class CartItem {
      constructor(_id, _title, _categoryId, _count) 
      {
         this.id = _id; this.count = parseInt(_count, 10); 
         this.title = _title; this.categoryId = _categoryId;
      }
      plusCount(_count) { this.count += _count; }
    }
    cart = [];

    function addToCart(id, title, categoryID, count)
    {
      wasAdded = false;
      for(i = 0; i < cart.length; i++)
      {
        c = cart[i];
        if(c.id === id && c.title === title) { c.count = Number(count) + Number(c.count); wasAdded = true; break; }
      }
      if(!wasAdded) cart.push(new CartItem(id, title, categoryID, count));
      localStorage.setItem('cart', JSON.stringify(cart));
      refreshCart();
    }
    function refreshCart() 
    {
      localCart = localStorage.getItem('cart');
      if(localCart) cart = JSON.parse(localCart);
      document.getElementById('cartH').innerText = 'Корзина: ' + cart.length + ' товаров';
    }

    function changePage(id)
    {
      var last = document.getElementsByClassName('navbar-brand')[0];
      var item = document.getElementById(id);
      if(item && last != item){last.className = 'nav-link';item.className = 'navbar-brand';}
    }

    refreshCart();

    function setCookie(name, value, options = {}) {    
      if (options.expires instanceof Date) options.expires = options.expires.toUTCString();
    
      let updatedCookie = name + '=' + value;
    
      for (let optionKey in options) {
        updatedCookie += '; ' + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) updatedCookie += '=' + optionValue;
      }
    
      document.cookie = updatedCookie;
    }

    function openCart()
    {
      if(cart.length > 0) 
      {
        setCookie('cart', localStorage.getItem('cart'), {'max-age': 3600 });
        window.open('CartPage.php');
      }
    }
    
    </script>";
  }
?>