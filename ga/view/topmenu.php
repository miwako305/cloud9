<!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="UTF-8">
     <title>映画飯</title>
     <link rel="stylesheet" hrf="html5reset-1.6.1.css">
     <link rel="stylesheet" href="movie.css">
</head>
 <body>
  <div id="pagebody">
   <div id="header">
    <table class="hedder">
     <tr class="logotitle">
      <img alt="映画飯ヘッダー画", src="img/structure/logo.png"></img>
      <a class="headertitle"></a>
      <form method="get" action="topmenu.php" >
       <input type="text" placeholder="検索">
       <input type="submit" value ="検索">
      </form>
      <a>ようこそ</a><?php print $user_name . "id" . $user_id ; ?><a>さん</a>
     </tr>
     <td>
      <tr>
       <a>カートの中は <?php print '0'; ?> です</a><br>
      </tr>
      <a href="cart.php" class="a.heddermenu">カートを見る</a>
     </td>
    </table>
    </div>
    <div class="header.menu">
     <table>
      <tr>
       <td><li class="gmenu"><a href="contactform" class="a.heddermenu">お問い合わせ</a></li></td>
       <td><li class="gmenu"><a href="topmenu.php" class="a.heddermenu">商品一覧</a></li></td>
      </tr>
     </table>
    </div>
    <div>
     <img alt="映画飯ヘッダー画", src="img/structure/hedder.png"></img>
    </div>
    <div id="cornerbox" >
     <div id ="ryouri.listbox">
      <a href="item_id.html">
       <div id="flex">
        <?php foreach ($data as $value)  { ?>
         <div class="item"widh="320" height="100" >
          <tr>
           <a class ="rabel" height="300";weight="200">
            <span class="img_size" widh="320" height="100" ><img src="<?php print  $img_dir . $value['img']; ?>"widh="50%" height="450" ></span><br>
           </a>
           <span><?php print $value['item_name']; ?></span>
           <span><?php print $value['price']; ?>円</span>
           <?php   if ($value['stock'] < 0) { ?>
            <span class="soldout">soldout！</span>
            <?php } ?>     
             <form   method="post"   >
              <input type="hidden" name="user_id" value="<?php print $user_id; ?>" >
              <input type= "hidden" name="item_id" value="<?php print $value['item_id']; ?> ">
               <select name="amount"><?php  for ($i = 1; $i <= 20; $i++) {?><option value="<?php print $i; ?>"> <?php print $i; } ?></option></select><a>&nbsp;&nbsp;個</a>
              <input type="submit" class="subumitbuttn" value="カートにいれる"> 
              </form>
             </div>
             <?php  }?>
            </div>
         
            </tr>

        </div>
       </div>
    <img alt="映画飯ヘッダー画", src="img/structure/hedder.png"></img>
    <div id="footer">
     <a>お問い合わせ先<a>
    </div>
  </body>
</html>
