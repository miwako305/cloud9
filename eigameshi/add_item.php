<?php
// MySQL接続情報
$host = 'localhost';
$username = 'miwako305'; // MySQLのユーザ名
$password = ''; // MySQLのパスワード
$dbname = 'ga'; // MySQLのDB名
$charset = 'utf8'; // データベースの文字コード
                    
// MySQL用のDNS文字列
$dsn = 'mysql:dbname=' . $dbname . ';host=' . $host . ';charset=' . $charset;

$img_dir = './img/'; // 画像のディレクトリ

$sql_kind = ''; // SQL処理の種類
$result_msg = ''; // 実行結果のメッセージ
$data = []; // DBから取得した値を格納する配列
$err_msg = []; // エラーメッセージを格納する配列
                  
// SQL処理を取得
if (isset($_POST['sql_kind']) === TRUE) {
    $sql_kind = $_POST['sql_kind'];
}

// 商品追加の場合は最初に入力項目をチェックする
if ($sql_kind === 'insert') {
    
    $new_name = '';
    $new_price = '';
    $new_stock = '';
    $new_status = '';
    $new_img = '';
    
    if (isset($_POST['new_name']) === TRUE) {
        // 半角・全角空白のトリム
        $new_name = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['new_name']);
    }
    
    if (isset($_POST['new_price']) === TRUE) {
        // 半角・全角空白のトリム
        $new_price = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['new_price']);
    }
    
    if (isset($_POST['new_stock']) === TRUE) {
        // 半角・全角空白のトリム
        $new_stock = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['new_stock']);
    }
    
    // HTTP POST でファイルがアップロードされたか確認
    if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
        
        $new_img = $_FILES['new_img']['name'];
        
        // 画像の拡張子取得
        $extension = pathinfo($new_img, PATHINFO_EXTENSION);
        
        // 拡張子を小文字にする
        $extension = strtolower($extension);
        
        // 拡張子チェック
        if ($extension === 'jpg' || $extension == 'jpeg' || $extension == 'png') {
            
            // ユニークIDを生成し、保存ファイルの名前を変更する
            $new_img = md5(uniqid(mt_rand(), true)) . '.' . $extension;
            
            // 同名ファイルが存在するか確認
            if (is_file($img_dir . $new_img) !== TRUE) {
                
                // ファイルを移動し保存
                if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img) !== TRUE) {
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
    // 変更の場合の入力項目チェック
    
    // 在庫
} else if ($sql_kind === 'update_stock') {
    
    $update_stock = '';
    $item_id = '';
    if (isset($_POST['update_stock']) === TRUE) {
        // 半角・全角空白のトリム
        $update_stock = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['update_stock']);
    }
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
    // 画像
} else if ($sql_kind === 'update_img') {
    
    $update_img = '';
    $item_id = '';
    if (isset($_FILES['update_img']['tmp_name']) === TRUE) {
        if (is_uploaded_file($_FILES['update_img']['tmp_name']) === TRUE) {
            $update_img = $_FILES['update_img']['name'];
            // 画像の拡張子取得
            $extension = pathinfo($update_img, PATHINFO_EXTENSION);
            // 拡張子を小文字にする
            $extension = strtolower($extension);
            // 拡張子チェック
            if ($extension === 'jpg' || $extension == 'jpeg' || $extension == 'png') {
                // ユニークIDを生成し、保存ファイルの名前を変更する
                $update_img = md5(uniqid(mt_rand(), true)) . '.' . $extension;
                // 同名ファイルが存在するか確認
                if (is_file($img_dir . $update_img) !== TRUE) {
                    // ファイルを移動し保存
                    if (move_uploaded_file($_FILES['update_img']['tmp_name'], $img_dir . $update_img) !== TRUE) {
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
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
    // 価格改定
} else if ($sql_kind === 'update_price') {
    $update_price = '';
    $item_id = '';
    if (isset($_POST['update_price']) === TRUE) {
        // 半角・全角空白のトリム
        $update_price = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['update_price']);
    }
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
} else if ($sql_kind === 'update_item_name') {
    $update_item_name = '';
    $item_id = '';
    if (isset($_POST['update_item_name']) === TRUE) {
        // 半角・全角空白のトリム
        $update_item_name = preg_replace('/\A[ \s]*|[ \s]*\z/u', '', $_POST['update_item_name']);
    }
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
} else if ($sql_kind === 'change') {
    $change_status = '';
    $item_id = '';
    if (isset($_POST['change_status']) === TRUE) {
        $change_status = $_POST['change_status'];
    } else {
        $err_msg[] = 'ステータスを選択してください。';
    }
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
    // 商品を削除する
} else if ($sql_kind === 'delete') {
    $delete_item = '';
    $item_id = '';
    if (isset($_POST['delete_item']) === TRUE) {
        $delete_item = $_POST['delete_item'];
    }
    if (isset($_POST['item_id']) === TRUE) {
        $item_id = $_POST['item_id'];
    }
}
try {
    // データベースに接続
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
        // 現在日時を取得
        $now_date = date('Y-m-d H:i:s');
        // 商品追加の場合
        if ($sql_kind === 'insert') {
            // トランザクション開始
            $dbh->beginTransaction();
            try {
                // SQL文を作成
                $sql = 'INSERT INTO items_master (item_name, price, img, create_datetime,status) VALUES (?, ?, ?, ?,?)';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $new_name, PDO::PARAM_STR);
                $stmt->bindValue(2, $new_price, PDO::PARAM_INT);
                $stmt->bindValue(3, $new_img, PDO::PARAM_STR);
                $stmt->bindValue(4, $now_date, PDO::PARAM_STR);
                $stmt->bindValue(5, $new_status, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // INSERTされたデータのIDを取得
                $item_id = $dbh->lastInsertId('item_id');
                // SQL文を作成
                $sql = 'INSERT INTO items_stock (item_id, stock, create_datetime) VALUES (?, ?, ?)';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $item_id, PDO::PARAM_INT);
                $stmt->bindValue(2, $new_stock, PDO::PARAM_STR);
                $stmt->bindValue(3, $now_date, PDO::PARAM_STR);
                // SQLを実行
                $stmt->execute();
                // コミット
                $dbh->commit();
                // 表示メッセージの設定
                $result_msg = '追加成功';
            } catch (PDOException $e) {
                // 例外をスロー
                throw $e;
            }
        } else if ($sql_kind === 'update_stock') {
            try {
                // SQL文を作成
                $sql = 'UPDATE items_stock SET stock = ?, update_datetime = ? WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $update_stock, PDO::PARAM_INT);
                $stmt->bindValue(2, $now_date, PDO::PARAM_STR);
                $stmt->bindValue(3, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = '在庫変更成功';
            } catch (PDOException $e) {
                // 例外をスロー
                throw $e;
            }
        } else if ($sql_kind === 'update_img') {
            try {
                // SQL文を作成
                $sql = 'UPDATE items_master SET img= ? WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $update_img, PDO::PARAM_STR);
                $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = '画像の変更';
            } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
            }
        } else if ($sql_kind === 'update_items_name') {
            try {
                // SQL文を作成
                $sql = 'UPDATE items_master SET item_name= ? WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $update_item_name, PDO::PARAM_STR);
                $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = '名前変更';
            } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
                // 例外をスロー
                throw $e;
            }
        } else if ($sql_kind === 'update_price') {
            try {
                // SQL文を作成
                $sql = 'UPDATE items_master SET price = ? WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $update_price, PDO::PARAM_INT);
                $stmt->bindValue(2, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = '価格変更';
            } catch (PDOException $e) {
                // ロールバック処理
                $dbh->rollback();
            }
        } else if ($sql_kind === 'change') {
            try {
                // SQL文を作成
                $sql = 'UPDATE items_master SET status = ?, create_datetime = ? WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $change_status, PDO::PARAM_INT);
                $stmt->bindValue(2, $now_date, PDO::PARAM_STR);
                $stmt->bindValue(3, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = 'ステータスを更新しました';
            } catch (PDOException $e) {
                // 例外をスロー
                throw $e;
            }
            // 商品削除
        } else if ($sql_kind === 'delete') {
            try {
                // SQL文を作成
                $sql = 'DELETE FROM items_master  WHERE item_id = ?';
                // SQL文を実行する準備
                $stmt = $dbh->prepare($sql);
                // SQL文のプレースホルダに値をバインド
                $stmt->bindValue(1, $item_id, PDO::PARAM_INT);
                // SQLを実行
                $stmt->execute();
                // 表示メッセージの設定
                $result_msg = '削除しました';
            } catch (PDOException $e) {
                // 例外をスロー
                throw $e;
            }
        }
    }
    try {
        // SQL文を作成
        $sql = 'SELECT
                  items_master.item_id,
                  items_master.item_name,
                  items_master.price,
                  items_master.img,
                  items_stock.stock,
                  items_master.status
                  FROM items_master JOIN items_stock
                  ON  items_master.item_id = items_stock.item_id';
        // SQL文を実行する準備
        $stmt = $dbh->prepare($sql);
        // SQLを実行
        $stmt->execute();
        // レコードの取得
        $rows = $stmt->fetchAll();
        // 1行ずつ結果を配列で取得します
        $i = 0;
        foreach ($rows as $row) {
            $data[$i]['item_id'] = htmlspecialchars($row['item_id'], ENT_QUOTES, 'UTF-8');
            $data[$i]['item_name'] = htmlspecialchars($row['item_name'], ENT_QUOTES, 'UTF-8');
            $data[$i]['price'] = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
            $data[$i]['img'] = htmlspecialchars($row['img'], ENT_QUOTES, 'UTF-8');
            $data[$i]['stock'] = htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8');
            $data[$i]['status'] = htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8');
            $i ++;
        }
    } catch (PDOException $e) {
        // 例外をスロー
        throw $e;
        $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
    }
} catch (PDOException $e) {
    $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。' . $e->getMessage();
}
include_once './view/add_item.php';