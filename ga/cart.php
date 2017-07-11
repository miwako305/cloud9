<?php

if (isset($_GET['item_id']) === TRUE) {
   print 'ここに入力した名前を表示：' . htmlspecialchars($_GET['item_id'], ENT_QUOTES, 'UTF-8');
} else {
   print '名前が送られていません';
}


//仮
$user_name='無し';
$amount=0;


// テンプレートファイル読み込み
include_once './view/cart.php';

