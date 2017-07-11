<?php
// DB接続情報
$host     = 'localhost';
$username = 'miwako305';   // MySQLのユーザ名
$password = '';   // MySQLのパスワード
$dbname   = 'kadai';   // MySQLのDB名
$charset  = 'utf8';   // データベースの文字コード

// MySQL用のDNS文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
$errors = [];   // エラーの場合、エラーメッセージを設定
$data   = [];   // DBから取得した表示データ
//

//
// 入力データをDBに登録し、登録しているデータをDBから取得する
//
try {
  // データベースに接続します
  $dbh = new PDO($dsn, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
   // 現在日時を取得
    $now_date = date('Y-m-d H:i:s');
　  // 登録しているデータをDBから取得する
　
  try {
    // SQL文を作成
    $sql = 'SELECT user_name, user_comment, create_datetime FROM post order by create_datetime desc';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQLを実行
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();

    // 1行ずつ結果を配列で取得します
    foreach ($rows as $row) {
      $data[] = $row;
    }
  } catch (Exception $e) {
    throw $e;
  }
  }

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ひとこと掲示板</title>
</head>
<body>
  <h1>ひとこと掲示板</h1>
  <?php } ?>
    <label>名前：<input type="text" name="user_name"></label>
    <label>ひとこと：<input type="text" name="user_comment" size="60"></label>
    <input type="submit" name="submit" value="送信">
  </form>
<?php
?>
  <ul>
    <?php
      // 登録データを表示する
      foreach ($data as $value) {
    ?>
    <li>
      <?php print htmlspecialchars($value[0], ENT_QUOTES, 'UTF-8');?>:
      <?php print htmlspecialchars($value[1], ENT_QUOTES, 'UTF-8');?>
      -<?php print htmlspecialchars($value[2], ENT_QUOTES, 'UTF-8');?>
    </li>
    <?php
      }
    ?>
  </ul>
</body>
</html>
