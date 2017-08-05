<?php
session_start();
if(isset($_SESSION['user_id']) === true){
    $user_id = $_SESSION['user_id'];
} else {
    //ログインされていなければログイン画面へ。
    header('Location: login.php');
    exit(); 
}
// session_start();
// if(isset($_SESSION['login']) == false)
// {
//     print 'ログインされていません';
//      print '<a href="login.php">ログイン画面へ</a>';
//      exit();
// }
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

$user_id = '1';//$_SESSION['userps'];
$user_name =$_SESSION['user_name'];

if(isset($_POST['sql_kind']) === TRUE ){
    $sql_kind =$_POST['sql_kind'];
    }
if ($sql_kind === 'insert_cart') {
    $amount="";
    $item_id="";
    $cart_id="";
    $user_id="";
    
    if (isset($_POST['amount']) === TRUE) {
        $amount =$_POST['amount'];
        }
    if (isset($_POST['item_id']) === TRUE) {
    $item_id =$_POST['item_id'];
    }
    if (isset($_POST['cart_id']) === TRUE) {
        $cart_id =$_POST['cart_id'];
        }
     if (isset($_POST['user_id']) === TRUE) {
      $user_id =$_SESSION['userps'];
     }
}elseif($sql_kind ==='update_cart') {
     $amount="";
     $item_id="";
     $cart_id ="";
    if (isset($_POST['update_amount']) === TRUE) {
        $update_amount = $_POST['update_amount'];
        
    }
    if (isset($_POST['item_id']) === TRUE) {
    $item_id =$_POST['item_id'];
    }
    if (isset($_POST['cart_id']) === TRUE) {
    $cart_id =$_POST['cart_id'];
    }
 }

try {
    // データベースに接続
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $create_datetime = date('Y-m-d H:i:s');
    $update_datetime = date('Y-m-d H:i:s');
    
    if ($sql_kind === 'insert_cart'){
     // SQL文を作成
        $sql = 'INSERT carts (item_id, amount, create_datetime,cart_id, user_id)
        VALUES(?, ?, ?, ? ,?)';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1,$item_id,     PDO::PARAM_INT);
        $stmt->bindValue(2,$amount,      PDO::PARAM_INT);
        $stmt->bindValue(3,$create_datetime,  PDO::PARAM_STR);
        $stmt->bindValue(4,$cart_id,     PDO::PARAM_INT);
        $stmt->bindValue(5,$user_id,     PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        // 表示メッセージの設定
        $result_msg = '初めてカートに入れました';

    }elseif($sql_kind === 'update_cart' ){
            // SQL文を作成
            $sql = 'UPDATE carts SET amount = ?, update_datetime = ? WHERE item_id = ? AND user_id = ? ';
            // SQL文を実行する準備
            $stmt = $dbh->prepare($sql);
            // SQL文のプレースホルダに値をバインド
            $stmt->bindValue(1, $update_amount,                 PDO::PARAM_INT);
            $stmt->bindValue(2, $update_datetime,           PDO::PARAM_STR);
            $stmt->bindValue(3, $item_id,                    PDO::PARAM_INT);
            $stmt->bindValue(4, $user_id,                    PDO::PARAM_INT);
            // SQLを実行
                  $stmt->execute();
            // 表示メッセージの設定
            $result_msg = '数量を変更しました';
            
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
             WHERE carts.item_id =? ';
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
      $data[$i]['amount']      = htmlspecialchars($row['amount'],      ENT_QUOTES, 'UTF-8');
      $data[$i]['cart_id']      = htmlspecialchars($row['cart_id'],      ENT_QUOTES, 'UTF-8');
      $i++;
    }
    }catch (PDOException $e) {
        $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
    }
// テンプレートファイル読み込み
include_once'view/cart.php';