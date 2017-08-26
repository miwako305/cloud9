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
$user_id = $_SESSION['user_id'];
$datalist_item=$_POST['datalist_item'];
var_dump($datalist_item);


try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 $sql = 'SELECT
              items_master.item_id,
              items_master.item_name,
              items_master.price,
              items_master.img,
              carts.amount,
              carts.cart_id 
              FROM
              items_master
              LEFT OUTER JOIN carts
             ON items_master.item_id = carts.item_id
             WHERE carts.user_id = ?';
             
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
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
  <?php foreach ($data as $value)  { ?>
              
                <tr>
                  <td class="cart_img"><span class="img_size"><img src="<?php print  $img_dir . $value['img']; ?>"widh="81" height="50" ></span></td>
                  <td class="cart_name"><span class="cart_item_name"><?php print $value['item_name']; ?></span></td>
                  <td class="cart_price"><span class="cart_item_price"><?php print $value['price']; ?>円</span></td>
                </tr>
<?php } ?>
購入ありがとうございました。
  <a href = "/ga/topmenu.php">商品一覧に戻る</a></td>
  </body>
</html>
