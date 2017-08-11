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
$dbname   = 'ga';     // MySQLのDB名
$charset  = 'utf8';  // データベースの文字コード

// MySQL用のDNS文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
$img_dir    = './img/';  // 画像のディレクトリ
$sql_kind   = '';     // SQL処理の種類
$result_msg = '';     // 実行結果のメッセージ
$data       = [];     // DBから取得した値を格納する配列
$err_msg    = [];     // エラーメッセージを格納する配列
$user_name =$_SESSION['user_name'];
$user_id =$_SESSION['user_id'];


if (isset($_POST['item_id']) === TRUE) {
  $item_id = $_POST['item_id'];
}
if (isset($_POST['amount']) === TRUE) {
  $amount = $_POST['amount'];
}
  // 現在日時を取得
$now_date = date('Y-m-d H:i:s');

try {
    // データベースに接続
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
 
     if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //select文でカート内のデータを取得
  $item_id = $_POST['item_id'];
    $sql = 'SELECT
               carts.user_id,
               carts.item_id,
               carts.amount
          FROM carts 
          WHERE item_id=?
          AND user_id = ?';
            $stmt = $dbh->prepare($sql);
 // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $item_id,    PDO::PARAM_INT);
    $stmt->bindValue(2, $user_id,    PDO::PARAM_INT);
    // SQLを実行
    $stmt->execute();
    var_dump($item_id);
    // カート内のレコードの取得
    $cart_list = $stmt->fetchAll();
    var_dump($cart_list);
    // 1行ずつ結果を配列で取得します
									$i = 0;
									foreach ($cart_list as $row) {
											$cart[$i]['item_id']   = htmlspecialchars($row['item_id'],   ENT_QUOTES, 'UTF-8');
											$cart[$i]['amount']      = htmlspecialchars($row['amount'],      ENT_QUOTES, 'UTF-8');
											$cart[$i]['user_id']    = htmlspecialchars($row['user_id'],    ENT_QUOTES, 'UTF-8');
										 $i++;
											
									}


    //カート内に該当のレコードがあるかどうかをチェック
    if(count($cart_list) >= 1){ //レコードが一つ以上取得できれば

      $sql = 'UPDATE carts
        SET amount = ?
        WHERE item_id = ?
        AND user_id = ?';
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, $amount,     PDO::PARAM_INT);
      $stmt->bindValue(2, $item_id,    PDO::PARAM_INT);
      $stmt->bindValue(3, $user_id,    PDO::PARAM_INT);
      $stmt->execute();
           var_dump($item_id);
            var_dump($user_id);
   }elseif(count($cart_list) < 1){
       $created_datetime = date('Y-m-d H:i:s');
        $sql = 'INSERT carts (item_id, user_id, amount, create_datetime)
            VALUES(?, ?, ?, ?)';
            
            // SQL文を実行する準備
            $stmt = $dbh->prepare($sql);
            // SQL文のプレースホルダに値をバインド
            $stmt->bindValue(1,$item_id,     PDO::PARAM_INT);
            $stmt->bindValue(2,$user_id,     PDO::PARAM_INT);
            $stmt->bindValue(3,$amount,      PDO::PARAM_INT);
            $stmt->bindValue(4,$created_datetime,  PDO::PARAM_STR);

            // SQLを実行
            $stmt->execute();
            $result_msg = '初めてカートに入れました';
            var_dump($item_id);
            var_dump($user_id);

        }
     }
    // SQL文を作成
									$sql = 'SELECT
									items_master.item_id,
									items_master.item_name,
									items_master.price,
									items_master.img,
									items_stock.stock,
									items_master.status
									FROM items_master JOIN items_stock
									ON  items_master.item_id = items_stock.item_id
									WHERE items_master.status=1';
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
											$data[$i]['stock']      = htmlspecialchars($row['stock'],      ENT_QUOTES, 'UTF-8');
											$data[$i]['status']    = htmlspecialchars($row['status'],    ENT_QUOTES, 'UTF-8');
										 $i++;
											
									}

}catch (PDOException $e) {
    $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
    // var_dump($e);
}

// テンプレートファイル読み込み
include_once'view/topmenu.php';//topmenu.php';/topmenu.php';/topmenu.php';/topmenu.php';/topmenu.php';/topmenu.php';/topmenu.php';