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
if(isset($_POST['sql_kind']) === true ){
  $sql_kind =$_POST['sql_kind'];
}

if (isset($_POST['cart_id']) === TRUE) {
  $cart_id = $_POST['cart_id'];
}

try {
    // データベースに接続
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 現在日時を取得
    $now_date = date('Y-m-d H:i:s');   

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
    if($sql_kind==='cart_update'){
    $amount = $_POST['amount'];
    $item_id= $_POST['item_id'];
        
      $sql = 'UPDATE carts
             SET amount = ?
             WHERE item_id = ?';
             
      $stmt = $dbh->prepare($sql);
      
      $stmt->bindValue(1, $amount,     PDO::PARAM_INT);
      $stmt->bindValue(2, $item_id,    PDO::PARAM_INT);      $stmt->bindValue(3, $user_id,    PDO::PARAM_INT);
      $stmt->execute();
    }elseif ($sql_kind === 'cart_delete') {
   $cart_id= $_POST['cart_id'];
	// SQL文を作成
	$sql = 'DELETE FROM carts  WHERE cart_id = ?';
	// SQL文を実行する準備
	$stmt = $dbh->prepare($sql);
	// SQL文のプレースホルダに値をバインド
	$stmt->bindValue(1, $cart_id,       PDO::PARAM_INT);
	// SQLを実行
	$stmt->execute();
	// 表示メッセージの設定
	$result_msg = '削除しました';
	var_dump($cart_id);														
    }elseif ($sql_kind === 'buy'){
    $amount_order = $_POST['amount'];
    $item_id= $_POST['item_id'];
    
      $now_date = date('Y-m-d H:i:s');
     $sql =  'INSERT INTO oders (user_id, item_id, amount, create_datetime) 
              VALUES (?, ?, ?, ?)';
              $stmt = $dbh->prepare($sql);
              // SQL文のプレースホルダに値をバインド
       $cart_list=array();
      var_dump($item_id);
       $stmt->execute($cart_list);
    
    }
    }
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
    $buy_item_id = $rows['item_id'];
    $buy_cart_id = $rows['cart_id'];
    $buy_amount = $rows['amount'];
    $price = $rows['price'];
    $priceamount = $price*$buy_amount; 
    // 1行ずつ結果を配列で取得します
    $i = 0;
    foreach ($rows as $row) {
        $data[$i]['item_id']   = htmlspecialchars($row['item_id'],   ENT_QUOTES, 'UTF-8');
        $data[$i]['item_name'] = htmlspecialchars($row['item_name'], ENT_QUOTES, 'UTF-8');
        $data[$i]['price']      = htmlspecialchars($row['price'],      ENT_QUOTES, 'UTF-8');
        $data[$i]['img']        = htmlspecialchars($row['img'],        ENT_QUOTES, 'UTF-8');
        $data[$i]['amount']      = htmlspecialchars($row['amount'],      ENT_QUOTES, 'UTF-8');
        $data[$i]['cart_id']      = htmlspecialchars($row['cart_id'],      ENT_QUOTES, 'UTF-8');
        $i++;
       } 
    $cartitem_id[]=$row['item_id'];
    
}catch (PDOException $e) {
    $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
    var_dump($e);
    
}

// テンプレートファイル読み込み
include_once'view/cart.php';