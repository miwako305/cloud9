<?php
/* 会員登録ページ */
// データベースの接続情報
// $dsn の代わりにDSNが使えるようになりました。
define('DB_USER', 'miwako305'); // MySQLのユーザ名
define('DB_PASSWD', ''); // MySQLのパスワード
define('DSN', 'mysql:dbname=ga;host=localhost;charset=utf8');
$tel_regex = '/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}/';
$err_msg = []; // エラーメッセージ用の配列
$result_msg = ''; // 実行結果のメッセージ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 各種変数の初期化
    $user_name = '';
    $userps = '';
    $user_phone = '';
    $user_mail = '';
    $user_adress= '';
    if (isset($_POST['user_name']) === TRUE) {
        // issetでのチェック
        $user_name = preg_replace('/^[\s　]+|[\s　]+$/u', '', $_POST['user_name']);
        // 全角と半角の空白を取り除く。受け取り
    }
    // 1.ここからエラーチェック（ユーザー名）
    if ($user_name === '') {
        // 未入力チェック
        $err_msg[] = 'ユーザー名を入力してください。';
    } else if (preg_match('/^[a-z\d_]{6,20}$/i', $_POST['user_name']) !== 1) { // 正規表現チェック
        $err_msg[] = "ユーザー名は半角英数字6文字以上でご入力ください。";
    }
    // 2.ここからエラーチェック（パスワード）
    // 2.1未入力チェック
    if (isset($_POST['userps']) === TRUE) {
        // issetで、$_POST［］の入力がしっかり入っているかのチェック
        // 全角と半角の空白を取り除く。(空白は頭と末尾のみ取り除く）値の受け取り
        $userps = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['userps']);
    }
    if ($userps === '') {
        // 2.2 入力チェック
        $err_msg[] = 'パスワードを入力してください。';
    } else if (preg_match('/^[a-z\d_]{6,20}$/u', $userps) !== 1) {
        // 正規表現チェック
        $err_msg[] = "パスワードは半角英数字6文字以上でご入力ください。";
    }
    // 3.ここからエラーチェック（電話番号）
    if (isset($_POST['user_phone']) === TRUE) {
        // 全角と半角の空白を取り除く。(頭と末尾の空白のみ）値の受け取り
        $user_phone = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['user_phone']);
    }
    if ($user_phone === '') {
        $err_msg[] = '電話番号を入力してください。';
    } else if (preg_match('/^[0-9]{8,9}$/', $user_phone) !== 1) {
        $err_msg[] = "電話番号は全角記入もしくは正しく入力されてません。";
    }
    // 4.ここからエラーチェック（住所）
    if (isset($_POST['user_adress']) === TRUE) {
        // 全角と半角の空白を取り除く。(頭と末尾の空白のみ）値の受け取り
        $user_adress = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['user_adress']);
    }
    if ($user_adress === '') {
        $err_msg[] = '住所を入力してください。';
    } 
    // 5.ここからエラーチェック（メールアドレス）
    if (isset($_POST['user_mail']) === TRUE) {
        // 全角と半角の空白を取り除く。(頭と末尾の空白のみ）値の受け取り
        $user_mail = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['user_mail']);
    }
    if ($user_mail === '') {
        $err_msg[] = 'メールアドレスを入力してください。';
    } else if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $user_mail) !== 1) {
        $err_msg[] = "メールアドレスが間違っています";
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
            if (count($rows) >= 1) {
                // if ($_POST['user_name'] === $user_name) {
                $err_msg[] = 'ユーザ名がすでに登録されています。';
            }
        } catch (PDOException $e) {
            $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
        }
        
        // 現在日時を取得
        $now_date = date('Y-m-d H:i:s');
        
        // エラーがなければユーザーをinsert
        try {
            $sql = 'INSERT INTO users (user_name, userps, created_at ,user_mail, user_adress, user_phone)
     VALUES (?,?,?,?,?,?)';
            // SQL文を実行する準備
            $stmt = $dbh->prepare($sql);
            // SQL文のプレースホルダに値をバインド
            $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
            $stmt->bindValue(2, $userps, PDO::PARAM_STR);
            $stmt->bindValue(3, $now_date, PDO::PARAM_STR);
            $stmt->bindValue(4, $user_mail, PDO::PARAM_STR);
            $stmt->bindValue(5, $user_adress, PDO::PARAM_STR);
            $stmt->bindValue(6, $user_phone, PDO::PARAM_STR);
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
