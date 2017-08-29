<!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="UTF-8">
     <title>映画飯</title>
     <link rel="stylesheet" href="view/html5reset-1.6.1.css">
     <link rel="stylesheet" href="view/cart.css">
     <meta name="description" content="映画も料理も楽しみたい。映画にまつわる料理をお取り寄せ。いつもは食べないご飯と映画の世界を味わってください">
     <meta name="keywords" content="映画,ゲテモノ,面白い,料理,飯,料理,洋画">
    <link rel="icon" href="./img/icon/favicon.ico" type="image/png" sizes="18x18">
</head>
<body>
<div id="pagebody">
    <div id="headder">
       
      <table id ="heddercontainer" >
          <td id ="toplogo">
            <img src = "img/structure/logo.png"  width="100" height="auto">
            <h1>購入画面</h1><br>
          </td>
         <td id="name">          
             <a>ようこそ</a>
             <?php print $user_name; ?>
              <a>さん</a><br>
            <tr >
            </tr>
        </td>
        
       </table>
        
    </div>
    <div id="main">
        <div id ="maincontener">
        <table id="cart_box" >
            <caption>
            <td>
              
            </td>
            <td>
                商品名
            </td>
            <td>
                価格
            </td>
            <td>
                数量
            </td>
            <td>
            </td>
    　　　    　　　<?php foreach ($data as $value)  { ?>
                <tr>
                  <td class="cart_img"><span class="img_size"><img src="<?php print  $img_dir . $value['img']; ?>"widh="81" height="50" ></span></td>
                  <td class="cart_name"><span class="cart_item_name"><?php print $value['item_name']; ?></span></td>
                  <td class="cart_price"><span class="cart_item_price"><?php print $value['price']; ?>円</span></td>
                  <td class="cart_amount"><span class="cart_item_amount"><?php print $value['amount']; ?></span><br></td>
                  <td class="cart_delete">
                     <form method="post"> 
                      <input type= "hidden" name="item_id" value="<?php print $value ['item_id']; ?>">
                      <input type="hidden" name="sql_kind" value= "cart_delete"  >
                      <input type="submit" class="subumitbuttn" value="削除"> 
                     </form>
                  </td><br>
                  <?php }  ?><br>
                </tr>
                </td>
                </caption>
            </table>
            <table id="top_boder">
             <td></td>
             <td></td>
              <td id="sumbox"> 請求金額：<?php print "無料です" ?></td><br>
             <td></td>
              
              <td class ="textbottum"> 
              <form method="post" action= "/ga/buy.php"> 
                      <input type= "hidden" name="item_id" value="<?php print $value ['item_id']; ?>">
                      <input type="hidden" name="sql_kind" value= "cart_delete"  >
                      <input type="submit" class="subumitbuttn" value="購入する"> 
                     </form>
            　<td class ="textbottum"> 
              <a href = "/ga/topmenu.php">商品一覧に戻る</a></td>
            </table>
           </div>
         </div><br>
        
    </div>
</div>
</body>
</html>