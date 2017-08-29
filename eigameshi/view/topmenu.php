<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>映画飯</title>
    <link rel="stylesheet" href="html5reset-1.6.1.css">
    <link rel="stylesheet" href="eigameshi/movie.css">
    <link rel="icon" href="./img/icon/favicon.ico" type="image/png" sizes="18x18">
    <style>
#pagebody{
    width:auto;
    padding:0;
    margin:0 auto;
    font-size: 1ex;
    height:100%;
    width:100%;
    height:auto;
}    

#main{
background-color:rgb(60, 60, 70);
margin:0 auto;
width:100%;
height:auto;
}

.maincontener{
     width:80%;
    padding:0px;
    margin:0px,100px;
    font-size: 1ex;
    background-color: white;
    height:auto;
    
    
}

/*topmenu*/

#hedderimg{
    width: 100%;
    height: 35px;
}

/*cartcss*/

/*ログイン画面*/

#login-inform{
    margin:0 auto;
    width:50%;
}
block{
    vertical-align: right;
    width:30%;
    height:15px;
}

#login_box{
    font-size:0.75em;
display:block;
float: left;
width:140px;
border-radius: 15px;
}
    </style>
</head>
<body>
    <div id="pagebody">
        <div id="header">
            <table class="hedder">
                <th class="logotitle">
                    <img alt="映画飯ヘッダー画" src="img/structure/logo.png">
                    <a class="headertitle"></a>
                </th>
                <th>
                    <form method="get" action="topmenu.php">
                        <input type="text" placeholder="検索"> <input type="submit" value="検索">
                    </form>
                </th>
                <th>
                    <a>ようこそ<?php print $user_name . "id" . $user_id ; ?>さん</a><br>
                    <a>カートの中は <?php print '0'; ?> です</a>
                </th>
                <br>
                            </table>
        </div>
        <div class="header.menu">
            <table>
                <tr>
                    <td>
                        <li class="gmenu"><a href="contactform" class="a.heddermenu">お問い合わせ</a></li>
                    </td>
                    <td>
                        <li class="gmenu"><a href="topmenu.php" class="a.heddermenu">商品一覧</a></li>
                    </td>
                <td>
                    <a href="cart.php" class="a.heddermenu">カートを見る</a>
                </td>
                <td>
                    <a href="login.php" class="a.heddermenu">ログイン画面に戻る</a>
                </td>
                </tr>
            </table>
        </div>
        <div>
            <img alt="映画飯ヘッダー画" , src="img/structure/hedder.png" width="2000"></img>
        </div>
        <div id="cornerbox">
            <div id="ryouri.listbox">
                <a href="item_id.html">
                    <div id="flex">
                        <?php foreach ($data as $value)  { ?>
                        <div class="item" widh="320" height="100">
                            <a class="rabel" height="300" ;weight="200"> <span
								class="img_size" widh="320" height="100"><img
									src="<?php print  $img_dir . $value['img']; ?>" widh="50%"
									height="450"></span><br>
							</a> <span><?php print $value['item_name']; ?></span> <span><?php print $value['price']; ?>円</span>
                            <?php   if ($value['stock'] < 0) { ?>
                            <span class="soldout">soldout！</span>
                            <?php } ?>
                            <form method="post">
                                <input type="hidden" name="user_id" value="<?php print $user_id; ?>"> <input type="hidden" name="item_id" value="<?php print $value['item_id']; ?> "> <select name="amount"><?php  for ($i = 1; $i <= 20; $i++) {?><option
										value="<?php print $i; ?>"> <?php print $i; } ?></option></select><a>&nbsp;&nbsp;個</a>
                                <input type="submit" class="subumitbuttn" value="カートにいれる">
                            </form>
                        </div>
                        <?php  }?>
                    </div>
            </div>
        </div>
        <img alt="映画飯ヘッダー画" , src="img/structure/hedder.png" width="2000"></img>
    </div>

</body>

</html>
