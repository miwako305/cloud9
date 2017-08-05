<?php
session_start();
if(isset($_SESSION['user_id']) === true){
    $user_id = $_SESSION['user_id'];
} else {
    //ログインされていなければログイン画面へ。
    header('Location: login.php');
    exit(); 
}

// MySQL接続情報
$host     = 'localhost';
$username = 'miwako305';   // MySQLのユーザ名
$password = '';       // MySQLのパスワード
$dbname   = 'ga';   // MySQLのDB名
$charset  = 'utf8';   // データベースの文字コード

// MySQL用のDNS文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
$data= [];
$img_dir= './img/';  // 画像のディレクトリ
$err_msg= [];   // エラーメッセージを格納する配列
///仮染めユーザ-
$user_id=0;
$user_name="名前";


try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  try {
   $sql = 'SELECT
   items_master.item_id,
   items_master.item_name,
   items_master.price,
   items_master.img,
   carts.amount
   FROM items_master JOIN carts
   ON  items_master.item_id = carts.item_id';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQLを実行
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    // 1行ずつ結果を配列で取得します
    $i = 0;
    foreach ($rows as $row) {
     $data[$i]['item_id']   = htmlspecialchars($row['item_id'],   ENT_QUOTES, 'UTF-8');
     $data[$i]['item_name'] = htmlspecialchars($row['item_name'], ENT_QUOTES, 'UTF-8');
     $data[$i]['price']      = htmlspecialchars($row['price'],      ENT_QUOTES, 'UTF-8');
     $data[$i]['img']        = htmlspecialchars($row['img'],        ENT_QUOTES, 'UTF-8');
     $data[$i]['user_id']        = htmlspecialchars($row['img'],        ENT_QUOTES, 'UTF-8');
     $data[$i]['amount']      = htmlspecialchars($row['amount'],      ENT_QUOTES, 'UTF-8');
     $i++;
    }
    }catch (PDOException $e) {
        $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
    }
   }catch (PDOException $e) {
    $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
   }
 ?> 

<!DOCTYPE html>
<html lang="ja">
<head>
     <meta charset="UTF-8">
     <title>映画飯</title>
     <link rel="stylesheet" href="html5reset-1.6.1.css">
     <link rel="stylesheet" href="topmenu.css">
</head>
 <body>
購入ありがとうございました。

  </body>
</html>
