<!DOCTYPE html>
<html lang="ja">
   <head>
     <meta charset="UTF-8">
     <title>映画飯</title>
     <link rel="stylesheet" href="html5reset-1.6.1.css">
     <link rel="stylesheet" href="topmenu.css">
    </head>
    <body>
     <div id="pagebody">
      <div id="header">
     　<table class="hedder">
        <tr class="logotitle">
          <img src = "img/logo.png"  width="370" height="80"><br>
          <a class="headertitle"></a>
         <form method="get" action="レシピ検索" >
          <input type="text" placeholder="検索">
          <input type="submit" value ="検索">
         </form>
         <a>ようこそ</a>
         <?php print $user_name; ?> </a>
         <a>さん</a>
        </tr>
        <tr>
         <a>カートの中は</a>
         <a><?php print $amount;?></a>
         <a>です。</a>
        </tr>
       </table>
       </header>
       <div class="header.menu">
        <table>
            <tr>
                <td><li class="gmenu"><a href="contactform" class="a.heddermenu">お問い合わせ</a></li></td>
                <td><li class="gmenu"><a href="contactform" class="a.heddermenu">商品一覧</a></li>
                </td>
            </tr>
        </table>   
       
       </div>
       <div>
        <img src="画面", width="960" height="90"></img>
       </div>
       <div id="cornerbox" >

        <div id ="ryouri.listbox">
         <a href="item_id.html">
         
          <label>
            <a class ="rabel">
          
        <div id="flex">
        <?php foreach ($data as $value)  { ?>
        <div class="item">
            <tr>
                <span class="img_size"><img src="<?php print  $img_dir . $value['img']; ?>"widh="320" height="90" ></span>
                </a>
                </label>
                <span><?php print $value['item_name']; ?></span>
                <span><?php print $value['price']; ?>円</span> 
              <form action="cart.php" method="get" name= "cart" >
                 <input type="submit" class="subumitbuttn" value="カートにいれる" ></td>
<php>
                  <input type= "hidden" name="item_id" value= $value ['item_id']  >
                  <input type="hidden" name="sql_kind" value= insert_cart  >
                   <input type="hidden" name="price" value= <?php $value['price'] ?> >
              </form>
                </a>
            </tr>
        <?php } ?>
            
        </div>
       </div>
    <div id="footer">
     <a>お問い合わせ先<a>
    </div>
  </body>
</html>
<input type= "hidden" name="item_id" value="<?php print $value['item_id']; ?>" >