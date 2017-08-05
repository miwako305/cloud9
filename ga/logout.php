<?php
/* 最終課題の会員登録ページ */

// データベースの接続情報
//$dsn の代わりにDSNが使えるようになりました。
define('DB_USER',   'miwako305');    // MySQLのユーザ名
define('DB_PASSWD', '');    // MySQLのパスワード
define('DSN', 'mysql:dbname=ga;host=localhost;charset=utf8');  
   
    $date = [];
    $err_msg = [];  // エラーメッセージ用の配列
    $result_msg = '';     // 実行結果のメッセージ
    
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $user_name = ''; //初期化
    $userps = '';
          
   if (isset($_POST['user_name']) === TRUE) { //issetでのチェック
      $user_name = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['user_name']);  //全角と半角の空白を取り除く。受け取り
    }
    //ここからエラーチェック
    if($user_name === ''){ //未入力チェック
        $err_msg[] = 'ユーザー名を入力してください。';
    }else if(preg_match('/^[a-z\d_]{6,20}$/i', '', $_POST['user_name'])){ //正規表現チェック
        $err_msg[] = "ユーザー名は半角英数字6文字以上でご入力ください。";
    }
    
    if (isset($_POST['userps']) === TRUE) { //issetでのチェック
      $userps = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['userps']); //全角と空白をとる
    
    }
    //ここからエラーチェック
    if($userps === ''){ //未入力チェック
        $err_msg[] = 'パスワードを入力してください。';
    }else if(preg_match('/^[a-z\d_]{6,20}$/i', '', $_POST['userps'])){ //正規表現チェック
        $err_msg[] = "パスワードは半角英数字6文字以上でご入力ください。";
    }
  }
  
  // DB接続前にcount($err_msg)をチェック
  if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
   try {
     // データベースに接続
     //ここの$dsn, $username, $userpsがそれぞれ定数DSN, DB_USER, DB_PASSWDで置き換え
     $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     
     // 現在日時を取得
     $created_at = date('Y-m-d H:i:s');
     
     // select文で重複ユーザーの確認
    $sql = 'SELECT
            user_name
            FROM users
            WHERE user_name = ?';

    
     // SQL文を実行する準備
     $stmt = $dbh->prepare($sql);
     //SQLにプレスフォルダの値をバイント
     $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
     // SQLを実行
     $stmt->execute();
     // レコードの取得
     $rows = $stmt->fetchAll();
     
     // select文の実行結果が１行以上あればエラーメッセージを表示
     if ($_POST['user_name'] === $user_name) {
           $result_msg = 'ログイン成功';
     }
}  catch (PDOException $e) {
     $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
}
}

if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {

  // 現在日時を取得
  $now_date = date('Y-m-d H:i:s');
////
session_start();
// セッション変数からuser_id取得
if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  // 非ログインの場合、ログインページへリダイレクト
  header('Location: session_sample_top.php');
  exit;
}
// ユーザ名の取得（本来、データベースからユーザIDに応じたユーザ名を取得しますが、今回は省略しています）
$data[0]['user_name'] = 'コード太郎';
// ユーザ名を取得できたか確認
if (isset($data[0]['user_name'])) {
  $user_name = $data[0]['user_name'];
} else {
  // ユーザ名が取得できない場合、ログアウト処理へリダイレクト
  header('Location: logout.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ホーム</title>
</head>
<body>
  <p>ようこそ<?php print $user_name; ?>さん</p>
  <form action="./session_sample_logout.php" method="post">
    <input type="submit" value="ログアウト">
  </form>
</body>
</html>
    
}

include_once'view/loginform.php';