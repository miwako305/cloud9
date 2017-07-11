<?php

// DB接続情報
$host     = 'localhost';
$username = 'miwako305';   // MySQLのユーザ名
$password = '';   // MySQLのパスワード
$dbname   = 'kadai';   // MySQLのDB名
$charset  = 'utf8';   // データベースの文字コード

// MySQL用のDNS文字列
$dns = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;

$errors = [];   // エラーの場合、エラーメッセージを設定
$data   = [];   // DBから取得した表示データ

//
// 入力データの取得、チェック
//
if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  // 名前が正しく入力されているかチェックする
  // エラーの場合は、エラーメッセージを設定
  $user_name = '';
  // 未入力の場合
  if (isset($_POST['user_name']) !== TRUE || mb_strlen($_POST['user_name']) === 0){
    $errors['user_name'] = '名前を入力してください';

  } 
  // 20文字より大きい場合
  elseif (mb_strlen($_POST['user_name']) > 20){
    $errors['user_name'] = '名前は20文字以内で入力してください';

  } 
  // 正常の場合
  else {
    $user_name = $_POST['user_name'];

  }

  // ひとことが正しく入力されているかチェックする
  // エラーの場合は、エラーメッセージを設定
  $user_comment = '';
  // 未入力の場合
  if (isset($_POST['user_comment']) !== TRUE || mb_strlen($_POST['user_comment']) === 0){
    $errors['user_comment'] = 'ひとことを入力してください';

  } 
  // 100文字より大きい場合
  elseif (mb_strlen($_POST['user_comment']) > 100){
    $errors['user_comment'] = 'ひとことは100文字以内で入力してください';

  } 
  // 正常の場合
  else {
    $user_comment = $_POST['user_comment'];

  }
}

//
// 入力データをDBに登録し、登録しているデータをDBから取得する
//
try {
  // データベースに接続します
  $dbh = new PDO($dns, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {

    // 現在日時を取得
    $now_date = date('Y-m-d H:i:s');

    // 入力データをDBに登録する
    try {
      // SQL文を作成
      $sql = 'INSERT INTO post(user_name, user_comment, create_datetime) VALUES(?, ?, ?)';
      // SQL文を実行する準備
      $stmt = $dbh->prepare($sql);
      // SQL文のプレースホルダに値をバインド
      $stmt->bindValue(1, $user_name,     PDO::PARAM_STR);
      $stmt->bindValue(2, $user_comment,  PDO::PARAM_STR);
      $stmt->bindValue(3, $now_date,      PDO::PARAM_STR);
      // SQLを実行
      $stmt->execute();

      // リロード対策でリダイレクト
      header('Location: http://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

    } catch (PDOException $e) {
      throw $e;
    }
  }

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

} catch (PDOException $e) {
  // 接続失敗した場合
  $errors['db_connect'] = 'DBエラー：'.$e->getMessage();
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

  <form action="bbs2.php" method="post">
    <?php if (count($errors) > 0) { ?>
    <ul>
      <?php foreach ($errors as $error) { ?>
      <li>
        <?php print htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
      </li>
      <?php } ?>
    </ul>
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