<?php
// MySQL接続情報
$host     = 'localhost';
$username = 'miwako305';   // MySQLのユーザ名
$password = '';       // MySQLのパスワード
$dbname   = 'ga';   // MySQLのDB名
$charset  = 'utf8';   // データベースの文字コード
// MySQL用のDNS文字列
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
$img_dir    = './img/';  // 画像のディレクトリ
//格納庫の種類
$sql_kind   = '';     // SQL処理の種類
$result_msg = '';     // 実行結果のメッセージ
$data       = [];     // DBから取得した値を格納する配列
$err_msg    = [];     // エラーメッセージを格納する配列

// SQL処理を取得
if (isset($_POST['sql_kind']) === TRUE) {
  $sql_kind = $_POST['sql_kind'];
}

// 商品追加の場合は最初に入力項目をチェックする
if ($sql_kind === 'insert') {

  $newitemitem_name   = '';
  $newitemitem_price  = '';
  $newitemitem_img    = '';

  if (isset($_POST['newitemitem_name']) === TRUE) {
    // 半角・全角空白のトリム
    $newitemitem_name = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['newitemitem_name']);
  }

  if (isset($_POST['newitemitem_price']) === TRUE) {
    // 半角・全角空白のトリム
    $newitem_price = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['newitemitem_price']);
  }

  //  HTTP POST でファイルがアップロードされたか確認
  if (is_uploaded_file($_FILES['newitem_img']['tmp_name']) === TRUE) {

    $newitem_img = $_FILES['newitem_img']['name'];

    // 画像の拡張子取得
    $extension = pathinfo($newitem_img, PATHINFO_EXTENSION);

    // 拡張子を小文字にする
    $extension = strtolower($extension);

    // 拡張子チェック
    if ($extension === 'jpg' || $extension == 'jpeg' || $extension == 'png') {

      // ユニークIDを生成し、保存ファイルの名前を変更する
      $newitem_img = md5(uniqid(mt_rand(), true)) . '.' . $extension;

      // 同名ファイルが存在するか確認
      if (is_file($img_dir . $newitem_img) !== TRUE) {

        // ファイルを移動し保存
        if (move_uploaded_file($_FILES['newitem_img']['tmp_name'], $img_dir . $newitem_img) !== TRUE) {
          $err_msg[] = 'ファイルアップロードに失敗しました';
        }

      } else {

        // 生成したIDがかぶることは通常ないため、IDの再生成ではなく再アップロードを促すようにする
        $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
      }

    } else {
      $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
    }

  } else {
    $err_msg[] = 'ファイルを選択してください。';
  }
}


try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {

    // 商品追加の場合
    if ($sql_kind === 'insert') {

      // 現在日時を取得
      $nowitem_create_date = date('Y-m-d H:i:s');

      try {
        // SQL文を作成
        $sql = 'INSERT INTO items (newitem_name, newitem_price, newitem_img, nowitem_create_datetime,nowitem_updatetaime) VALUES (?, ?, ?, ?, ?)';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQL文のプレースホルダに値をバインド
        $stmt->bindValue(1, $newitemitem_name,    PDO::PARAM_STR);
        $stmt->bindValue(2, $newitemitem_price,   PDO::PARAM_INT);
        $stmt->bindValue(3, $newitemitem_img,     PDO::PARAM_STR);
        $stmt->bindValue(4, $nowitem_create_datetime,    PDO::PARAM_STR);
        $stmt->bindValue(5, $nowitem_update_date,    PDO::PARAM_STR);
        // SQLを実行
        $stmt->execute();

        $result_msg =  '追加成功';

      } catch (PDOException $e) {
        // 例外をスロー
        throw $e;
      }
    }
  }

  try {
    // SQL文を作成
    $sql = 'SELECT 
              items.item_id,
              items.name,
              items.price,
              items.img
            FROM items';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQLを実行
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    // 1行ずつ結果を配列で取得します
    $i = 0;
    foreach ($rows as $row) {
      $data[$i]['items_id']   = htmlspecialchars($row['items_id'],   ENT_QUOTES, 'UTF-8');
      $data[$i]['items_name'] = htmlspecialchars($row['items_name'], ENT_QUOTES, 'UTF-8');
      $data[$i]['price']      = htmlspecialchars($row['price'],      ENT_QUOTES, 'UTF-8');
      $data[$i]['img']        = htmlspecialchars($row['img'],        ENT_QUOTES, 'UTF-8');
      $i++;
    }

  } catch (PDOException $e) {
    // 例外をスロー
    throw $e;
  }
} catch (PDOException $e) {
  $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>syouhinndashimasu</title>
  <style>
    section {
      margin-bottom: 20px;
      border-top: solid 1px;
    }

    table {
      width: 660px;
      border-collapse: collapse;
    }

    table, tr, th, td {
      border: solid 1px;
      padding: 10px;
      text-align: center;
    }

    caption {
      text-align: left;
    }

    .text_align_right {
      text-align: right;
    }

    .items_name_width {
      width: 100px;
    }

    .input_text_width {
      width: 60px;
    }
  </style>
</head>
<body>
<?php if (empty($result_msg) !== TRUE) { ?>
  <p><?php print $result_msg; ?></p>
<?php } ?>
<?php foreach ($err_msg as $value) { ?>
  <p><?php print $value; ?></p>
<?php } ?>

    <table>
      <caption>商品一覧</caption>
      <tr>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
      </tr>
<?php foreach ($data as $value)  { ?>
      <tr>
        <form method="post">
          <td><img src="<?php print $img_dir . $value['img']; ?>"></td>
          <td class="items_name_width"><?php print $value['items_name']; ?></td>
          <td class="text_align_right"><?php print $value['price']; ?>円</td>
        </form>
      <tr>
<?php } ?>
    </table>
  </section>
</body>
</html>
