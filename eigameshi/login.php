<?php
/* 会員ログインページ */
session_start();
// データベースの接続情報

define('DB_USER', 'miwako305'); // MySQLのユーザ名
define('DB_PASSWD', ''); // MySQLのパスワード
define('DSN', 'mysql:dbname=ga;host=localhost;charset=utf8');

$date = [];
$err_msg = []; // エラーメッセージ用の配列
$result_msg = ''; // 実行結果のメッセージ

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 初期化
    $user_name = '';
    $userps = '';
    $user_phone = '';
    $user_adress= '';
    $user_mail='';
    if (isset($_POST['user_name']) === TRUE) { 
        $user_name = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['user_name']); 
    }
    //1.ここからエラーチェック(ユーザー名)
    if ($user_name === '') { // 未入力チェック
        $err_msg[] = 'ユーザー名を入力してください。';
    } else if (preg_match('/^[a-z\d_]{6,20}$/i', $_POST['userps']) !== 1) { // 正規表現チェック
        $err_msg[] = "ユーザー名は半角英数字6文字以上でご入力ください。";
    }
    
    if (isset($_POST['userps']) === TRUE) { // issetでのチェック
        $userps = preg_replace('/^[\s　]+|[\s ]+$/u', '', $_POST['userps']); // 全角と半角の空白を取り除く。受け取り
    }
    
    //２.ここからエラーチェック（パスワード）
    if ($userps === '') { // 未入力チェック
        $err_msg[] = 'パスワードを入力してください。';
    } elseif (preg_match('/^[a-z\d_]{6,20}$/i', $_POST['userps']) !== 1) { // 正規表現チェック
        $err_msg[] = "パスワードは半角英数字6文字以上でご入力ください。";
    }
}
// DB接続前にcount($err_msg)をチェック
if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
    try {
        // データベースに接続
        $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        // 現在日時を取得
        $created_at = date('Y-m-d H:i:s');
        $user_id = "";
        $sql = 'SELECT
            user_id 
            FROM users
            WHERE user_name= ? AND userps = ?';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_name, PDO::PARAM_INT);
        $stmt->bindValue(2, $userps, PDO::PARAM_INT);
        // SQLを実行
        $stmt->execute();
        // レコードの取得
        $rows = $stmt->fetchAll();
        if (count($rows) >= 1) {
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_id'] = $rows[0]['user_id'];
            header('Location: topmenu.php');
            exit();
        } else {
            header('Location: login.php');
            exit();
            }
    } catch (PDOException $e) {
        $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
    }
}
// テンプレートファイル読み込み
include_once 'view/login.php';
    