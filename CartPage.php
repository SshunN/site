<!DOCTYPE html>
<html lang='ru' dir='ltr'>
  <head>
    <meta charset='utf-8'>
    <title>Главная</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <link rel='stylesheet' href='style/bootstrap.min.css'/>
    <link rel='stylesheet' href='style/navigation.css'>
    <link rel='stylesheet' href='style/footer.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Cookie' />
    <link rel='stylesheet' href='style/styles.css' />
  </head>
  <body>
    <?php
    include_once 'mainHeader.php';
    function a()
    {
      $arr = json_decode($_COOKIE["cart"],true);
      echo "<table>";
      foreach($arr as $a)
      {
        $id = $a['id'];
        echo "<tr>";
        $s = $a['name'];
        echo "<td>$s</td>";
        $s = $a['count'];
        echo "<td><input type='number' value='$s' min='0' max='20'/></td>";
        echo "<td><button onclick='removeGood($id)'>Удалить</button></td>";
        echo "</tr>";
      }
      echo "<tr><td><h7>Почта</h7></td>";
      echo "<td><input id='mailArea' type='text'/></td></tr>";
      echo "<tr><td><h7>Телефон</h7></td>";
      echo "<td><input id='telArea' type='text' value='' onkeyup='checkTelephone()'/></td></tr>";
      echo "<tr><td><button onclick='sendQuery()'>Отправить заказ</button></td></tr>";
    }
    a();
     ?>
     <script>
     function checkTelephone(){
       var tel = document.getElementById("telArea");
       if(isNaN(tel.value.slice(-1))) tel.value=tel.value.substring(0, tel.value.length - 1);
       if(tel.value.length > 11) tel.value=tel.value.substring(0, tel.value.length - 1);
     }
     function checkMail(){
       var mail = document.getElementById("mailArea");
       if(mail.value.length > 0)
       {
         dom = false;
         dot = false;
         for(i=0;i<mail.value.length;i++){
           if(dom && mail.value[i] == '.') return true;
           if(mail.value[i] == '@')
           {
             if(dom || i==0) return false;
             dom = true;
           }
         }
       }
       return false;
     }
     function removeGood(id){
       cart[id]=undefined;
       s = JSON.stringify(cart);
       document.cookie = "cart=" + s;
       localStorage.setItem('cart', s);
       window.location.href = "CartPage.php";
       checkCount();
     }
     function checkCount(){
       var a = document.getElementById("cE");
       if(a.innerText != "Корзина (1 товара)") window.location.href = "CartPage.php"; else window.location.href ="goodsPage.php";
     }
     function checkInfo(){
       var tel = document.getElementById("telArea");
       var mail = document.getElementById("mailArea");
       hasTel = false;
       hasMail = false;
       if(tel.value.length == 11) hasTel = true;
       if(checkMail()) hasMail = true;
       if(hasMail | hasTel) return true;
       return false;
     }
     function sendQuery(){
       if(checkInfo())
       {
         localStorage.clear();
         cart = {};
         document.cookie = "cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
         window.location.href = "goodsPage.php";
       }
       else alert("Укажите телефон или почту!");
     }
     </script>
     <?php
     function send(){
       $Message = $_POST['message'];
       $To      = $_POST['to'];
       $From    = $_POST['from'];
       $Subject = $_POST['subject'];

       $Headers = "From: $From\r\nReply-to: $From\r\nContent-type:text/html; charset=utf8\r\n";

       if(!empty($To) && !empty($From))
       {
         $result = SendMail($Message, $To, $Subject, $Headers);
       }
      }
      ?>
  </body>
</html>
