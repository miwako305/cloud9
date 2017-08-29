<?php
session_start();
if (isset($_SESSION['user_id']) === true) {
    $user_id = $_SESSION['user_id'];
} else {
    // ログインされていなければログイン画面へ。
    header('Location: login.php');
    exit();
}

// MySQL接続情報
$host = 'localhost';
$username = 'miwako305'; // MySQLのユーザ名
$password = ''; // MySQLのパスワード
$dbname = 'ga'; // MySQLのDB名
$charset = 'utf8'; // データベースの文字コード
                    
// MySQL用のDNS文字列
$dsn = 'mysql:dbname=' . $dbname . ';host=' . $host . ';charset=' . $charset;
$data = [];
$img_dir = './img/'; // 画像のディレクトリ
$err_msg = []; // エラーメッセージを格納する配列
$user_id = $_SESSION['user_id'];
try {
    // データベースに接続
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = 'DELETE FROM carts  WHERE user_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $user_id, PDO::PARAM_INT);
    // SQLを実行
    $stmt->execute();
    // 表示メッセージの設定
    $result_msg = '削除しました';
} catch (PDOException $e) {
    $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
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
	<a href="/ga/topmenu.php">商品一覧に戻る</a>
	</td>
</body>
</html>
