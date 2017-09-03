<?php
/* 最終課題の会員登録ページ */

// データベースの接続情報
// $dsn の代わりにDSNが使えるようになりました。
define('DB_USER', 'miwako305'); // MySQLのユーザ名
define('DB_PASSWD', ''); // MySQLのパスワード
define('DSN', 'mysql:dbname=ga;host=localhost;charset=utf8');

$date = [];
$err_msg = []; // エラーメッセージ用の配列
$result_msg = ''; // 実行結果のメッセージ

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $user_name = ''; // 初期化
    $userps = '';
    
    if (isset($_POST['user_name']) === TRUE) { // issetでのチェック
        $user_name = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['user_name']); // 全角と半角の空白を取り除く。受け取り
    }
    // ここからエラーチェック
    if ($user_name === '') { // 未入力チェック
        $err_msg[] = 'ユーザー名を入力してください。'; // 閉じかっこ一個多くなっちゃいましたね＾＾//ありがとうございます
    } else if (preg_match('/^[a-z\d_]{6,20}$/i', $_POST['user_name']) !== 1) { // 正規表現チェック
        $err_msg[] = "ユーザー名は半角英数字6文字以上でご入力ください。";
    }
    // はい。そうですね！もう一度確認してきます！
    // 登録できました！次はログインできないみたいですので、login.phpに移動します。
    if (isset($_POST['userps']) === TRUE) { // issetでのチェック
        $userps = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['userps']); // 全角と半角の空白を取り除く。受け取り
    }
    // ここからエラーチェック
    if ($userps === '') { // 未入力チェック //正規表現チェック
        $err_msg[] = 'パスワードを入力してください。'; // 全角のかっこになっちゃったみたいです。オッケーです＾＾はい＾＾またお気軽にどうぞ！ありがとうございます
    } else if (preg_match('/^[a-z\d_]{6,20}$/i', $_POST['userps']) !== 1) { // 正規表現チェック
        $err_msg[] = "パスワードは半角英数字6文字以上でご入力ください。";
    }
    
    // DB接続前にcount($err_msg)をチェック
    if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        try {
            // データベースに接続
            // ここの$dsn, $username, $userpsがそれぞれ定数DSN, DB_USER, DB_PASSWDで置き換え
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
            // SQLにプレスフォルダの値をバイント
            $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
            // SQLを実行
            $stmt->execute();
            // レコードの取得
            $rows = $stmt->fetchAll();
            
            // こちらです。見えますか？はい
            
            // このコメントと処理内容が違っています。select文の実行結果が入っているのは$rowsなので、となります。
            // これでこの部分は正しく動くはずなので確認して見ましょう。
            // 良かったです＾＾では、このあとログインしてもログイン後にチェックで弾かれるので、topmenu.phpに移動しましょう。hai
            
            // select文の実行結果が１行以上あればエラーメッセージを表示dekimashita!
            if (count($rows) >= 1) {
                // if ($_POST['user_name'] === $user_name) {
                $err_msg[] = 'ユーザ名がすでに登録されています。';
            }
        } catch (PDOException $e) {
            $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
        }
    }
    
    if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // 現在日時を取得
        $now_date = date('Y-m-d H:i:s');
        
        // エラーがなければユーザーをinsert
        try {
            $sql = 'INSERT INTO users (user_name, userps, created_at)
     VALUES (?, ?, ?)';
            // SQL文を実行する準備
            
            $stmt = $dbh->prepare($sql);
            
            // SQL文のプレースホルダに値をバインド
            $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
            $stmt->bindValue(2, $userps, PDO::PARAM_STR);
            $stmt->bindValue(3, $created_at, PDO::PARAM_STR);
            // SQLを実行
            $stmt->execute();
            // レコードの取得
            $rows = $stmt->fetchAll();
            
            // 1行ずつ結果を配列で取得します
            $i = 0;
            foreach ($rows as $row) {
                $data[$i]['user_name'] = htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8');
                $data[$i]['userps'] = htmlspecialchars($row['userps'], ENT_QUOTES, 'UTF-8');
                $data[$i]['created_at'] = htmlspecialchars($row['created_at'], ENT_QUOTES, 'UTF-8');
                $data[$i]['user_id'] = htmlspecialchars($row['user_id'], ENT_QUOTES, 'UTF-8');
                $i ++;
            }
            
            // 表示メッセージの設定
            $result_msg = 'アカウント作成が完了しました。<br>';
        } catch (PDOException $e) {
            // 例外をスロー
            throw $e;
        }
    }
}
include_once 'view/loginform.php';
