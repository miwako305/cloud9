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
        <a class="logotitle">
            <td class="headertitle">
                <img src="logo.png" width="192" height="70">
            </td>
        </a>
        <tr>
            <td>
                <form method="get" action="レシピ検索" >
                    <input type="text" placeholder="検索">
                    <input type="submit" value ="検索">
                 </form>
            </td>
            <td>
                <a>ようこそ</a>
                <a>
                   <?php
                 if (isset($_GET['my_name']) === TRUE) {
                print htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
                } else {
                print 'ストレンジャー';
                }
                ?>
                </a>
                <a>さん</a>
            </td>
        </tr>
        
        <tr id="cart">
            <td>
                <a>カートの中は</a>
                <a> <?php print '0個'?></a>
                <a>です。</a>
        
            </td>
         </tr>
       </table>
       <div class="header.menu">
           <table>
               <tr>
                   <td>
                   <li class="gmenu"><a href="contactform" class="a.heddermenu">お問い合わせ</a></li>
                   </td>
                   <td>
                   <li class="gmenu"><a href="contactform" class="a.heddermenu">商品一覧</a></li>  
                   </td>
               </tr>
           </table>
       </div>
       <div>
        <img src="画面" width="960" height="90"></img>
       </div>
       <div id="cornerbox" >

        <div id ="ryouri.listbox">
         <a href="item_id.html">
          <img src="iranryori.jpg" widh="400" height="150" ></img>
          <label>
            <a class ="rabel">
             カレーライス
            </a>
          </label>
         <img src="newRecipes1.jpg" widh="320" height="90" ></img>

         </a>
        </div>
       </div>
    <div id="footer">
     <a>お問い合わせ先<a>
    </div>
  </body>
</html>