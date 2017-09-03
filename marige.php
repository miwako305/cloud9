<?php
//データベース接続の準備
$host = 'localhost';
$username = 'sekiyayuto';
$password = '';
$dbname = 'camp';
$charset = 'utf8';

//POSTされた時の変数受け取り・エラーチェック
$img_dir = './img/'; //新しくアップした画像ファイルを保存するディレクトリ
$item_id = '';
$item_name = '';
$price = '';
$stock = '';
$create_datetime = '';
$update_datetime = '';
$err_msg = [];
$result_msg = '';
$data = [];
$new_img_filename = ''; //アップロードした新しい画像ファイル名
$status = '';
$vintage = '';
$description = '';
$process_kind = '';
$update_status = '';

//商品追加or変更ボタンorステータスボタンを押されたら$process_kindにinsert_itemかupdate_stockかupdate_statusが入る
if(isset($_POST['process_kind']) === TRUE){
	$process_kind = $_POST['process_kind'];
}

//POSTされたとき
//1.商品追加のボタンを押されたら(商品追加フォームより値を受け取る)
// アップロード画像ファイルについてのチェック
if($process_kind === 'insert_item'){
	$create_datetime = date('Y-m-d H:i:s');
		//ポストされた値を変数に代入する処理 値の正規化もしてください（半角や全角スペース削除）
		if(isset($_POST['item_name']) === TRUE){
			//preg_replaceで半角スペースと全角スペースを削除して正規化
			//入力されたドリンクネームの前後にスペースが入っている場合に削除してるだけです。
			$item_name = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['item_name']);
			//$item_name = $_POST['item_name'];
		}
		if(isset($_POST['price']) === TRUE){
			$price = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['price']);
		}
		if(isset($_POST['stock']) === TRUE){
			$stock = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['stock']);
		}
		if(isset($_POST['vintage']) === TRUE){
			$vintage = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['vintage']);
		}
		if(isset($_POST['wine_kind']) === TRUE){
			$wine_kind = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['wine_kind']);
		}
		if(isset($_POST['cooking_kind']) === TRUE){
			$cooking_kind = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['cooking_kind']);
		}
		if(isset($_POST['ingredient']) === TRUE){
			$ingredient = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['ingredient']);
		}
		if(isset($_POST['spice']) === TRUE){
			$spice = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['spice']);
		}
		//このあたりに＄_POST['status']を受け取る処理が必要です。
		if(isset($_POST['status']) === TRUE){
			$status = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['status']);
		}
		if(isset($_POST['description']) === TRUE){
			$description = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['description']);
		}
		
		//ここからは変数で受け取った値の文字数などのチェック
		
			//入力エラーが発生すれば$err_msg[]にエラーメッセージを格納
			if(mb_strlen($item_name) > 100){ //商品名が100字以上の場合
				$err_msg[] = '商品名は100文字以内で入力してください。';
			}if($item_name === ''){  //商品名が空欄の場合
				$err_msg[] = '商品名を入力してください。';
			}if($price === ''){  //値段が空欄の場合
				$err_msg[] = '値段を入力してください。';
			}if(preg_match("/^[1-9][0-9]*/", $price) !== 1){
				$err_msg[] = '値段は正の整数で入力してください。';
			}if($stock === ''){  //個数が空欄の場合
				$err_msg[] = '個数を入力してください。';
			}if(preg_match("/^[0-9]*/", $stock) !==1){
				$err_msg[] = '個数は正の整数で入力してください。';
			}if(mb_strlen($vintage) !== 4){ //vintageが4桁以外
				$err_msg[] = 'ヴィンテージは4桁で入力してください。';
			}if($vintage === ''){  //商品名が空欄の場合
				$err_msg[] = 'ヴィンテージを入力してください。';
			}if($wine_kind === ''){  //ワインの種類が空欄の場合
				$err_msg[] = 'ワインの種類を選択してください。';
			}if($cooking_kind === ''){  //料理の種類が空欄の場合
				$err_msg[] = '料理の種類を選択してください。';
			}if($ingredient === ''){  //食材が空欄の場合
				$err_msg[] = '食材を選択してください。';
			}if($spice === ''){  //味付けが空欄の場合
				$err_msg[] = '味付けを選択してください。';
			}if($description === ''){  //商品説明が空欄の場合
				$err_msg[] = '商品説明を入力してください。';
			}	
	// HTTP POST でファイルがアップロードされたかどうかチェック
	if (is_uploaded_file($_FILES['new_img']['tmp_name']) === TRUE) {
    	// 画像の拡張子を取得
    	$extension = pathinfo($_FILES['new_img']['name'], PATHINFO_EXTENSION);
    	// 指定の拡張子であるかどうかチェック
    	if ($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png') {
    		// 保存する新しいファイル名の生成（ユニークな値を設定する）
    		$new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
    			// 同名ファイルが存在するかどうかチェック
    			if (is_file($img_dir . $new_img_filename) !== TRUE) {
        			// アップロードされたファイルを指定ディレクトリに移動して保存
        			if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
            		$err_msg[] = 'ファイルアップロードに失敗しました';
        			}
    			} else {
        		$err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
    	}
    } else {
      $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEGのみ利用可能です。';
    }
  } else {
    $err_msg[] = 'ファイルを選択してください';
  }  
}
//2.在庫数変更のボタンを押されたら(在庫数変更フォームから値を受け取る)
	if($process_kind === 'update_stock'){
		if(isset($_POST['stock'])){
			$stock = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['stock']);
			$update_datetime = date('Y-m-d H:i:s');
		}
		if(isset($_POST['item_id'])){
			$item_id = preg_replace('/\A[　\s]*|[　\s]*\z/u', '',$_POST['item_id']);
		}
			if($stock === ''){  //個数が空欄の場合
				$err_msg[] = '個数を入力してください。';
			}else if(preg_match("/^[0-9]*/", $stock) !==1){
				$err_msg[] = '個数は正の整数で入力してください。';
			}
	}

//3.ステータス変更ボタンが押されたら
if($process_kind === 'update_status'){
	if(isset($_POST['item_id']) === TRUE){
		$item_id = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['item_id']);
	}
	if(isset($_POST['status']) === TRUE){
		$status = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['status']);
	}
	//反転処理しないといけません。
	if($status === 0){
		$update_status = 1;
	}else if($status === 1){
		$update_status = 0;
	}
			
}

//4.削除ボタンが押されたら
if($process_kind === 'delete'){
	if(isset($_POST['item_id']) === TRUE){
		$item_id = preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $_POST['item_id']);
	}
}


//データベースに接続してPDOオブジェクトを生成
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
try{
	//データベースに接続
	$dbh = new PDO($dsn,$username,$password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	//1.商品追加のボタンが押された場合
	if(count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST' ){
			
		//送られてきた非表示データによって処理の振り分け
		if($process_kind === 'insert_item'){
			try {
			    // SQL文を作成(商品情報テーブルにINSERT)
			    $sql = 'INSERT INTO b_m_products(item_name, price, img, status, create_datetime, stock, vintage, wine_kind, cooking_kind, ingredient, spice, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
			    // SQL文を実行する準備
			    $stmt = $dbh->prepare($sql);
			    // SQL文のプレースホルダに値をバインド
			    $stmt->bindValue(1, $item_name, PDO::PARAM_STR);
			    $stmt->bindValue(2, $price, PDO::PARAM_STR);
			    $stmt->bindValue(3, $new_img_filename, PDO::PARAM_STR);
			    $stmt->bindValue(4, $status, PDO::PARAM_INT);
			    $stmt->bindValue(5, $create_datetime, PDO::PARAM_STR);
			    $stmt->bindValue(6, $stock, PDO::PARAM_INT);
			    $stmt->bindValue(7, $vintage, PDO::PARAM_INT);
				$stmt->bindValue(8, $wine_kind, PDO::PARAM_INT);
				$stmt->bindValue(9, $cooking_kind, PDO::PARAM_INT);
				$stmt->bindValue(10, $ingredient, PDO::PARAM_INT);
				$stmt->bindValue(11, $spice, PDO::PARAM_INT);
			    $stmt->bindValue(12, $description, PDO::PARAM_STR);
			    // SQLを実行
			    $stmt->execute();
		    	$result_msg = '商品を追加しました。';
			}catch (PDOException $e) {
	    			throw $e;
			}	
		}
		//2.変更ボタンを押された場合(UPDATE処理)  
		else if($process_kind === 'update_stock'){
			try{
				//SQL文の作成
				$sql = 'UPDATE b_m_products SET stock = ?, update_datetime = ? WHERE item_id = ?';
				//SQL文を実行する準備
				$stmt = $dbh->prepare($sql);
				//SQL文のプレースホルダーに値をバインド
				$stmt->bindValue(1, $stock, PDO::PARAM_INT);
				$stmt->bindValue(2, $update_datetime, PDO::PARAM_STR);
				$stmt->bindValue(3, $item_id, PDO::PARAM_INT);
				//SQL文の実行
				$stmt->execute();
				$result_msg = '在庫数を変更しました。';
			}catch(PDOException $e){
				throw $e;
			}	
		}
		//3.ステータスボタンを押された場合
		else if($process_kind === 'update_status'){
			try{
				//SQL文の作成
				$sql = 'UPDATE b_m_products SET status = ? WHERE item_id = ?';
				//SQL文を実行する準備
				$stmt = $dbh->prepare($sql);
				//SQL文のプレースホルダーに値をバインド データ型に注意しましょう
				$stmt->bindValue(1, $update_status, PDO::PARAM_INT);
				$stmt->bindValue(2, $item_id, PDO::PARAM_INT);
				//SQL文の実行
				$stmt->execute();
				$result_msg = 'ステータスを変更しました。';
			}catch(PDOException $e){
				throw $e;
			}	
		}
		//4.削除ボタンを押された場合
		else if($process_kind === 'delete'){
			try{
				//SQL文の作成
				$sql = 'DELETE FROM b_m_products WHERE item_id = ?';
				//SQL文を実行する準備
				$stmt = $dbh->prepare($sql);
				//SQL文のプレースホルダーに値をバインド
				$stmt->bindValue(1, $item_id, PDO::PARAM_INT);
				//SQL文の実行
				$stmt->execute();
				$result_msg = '商品情報を削除しました。';
			}catch(PDOException $e){
				throw $e;
			}
		}
	}	
	
	
	
	// SELECT文で商品一覧の取得
	try {
		// SQL文を作成
		$sql = 'SELECT a.item_id, a.item_name, a.price, a.img, a.stock, a.vintage, a.wine_kind, a.cooking_kind, a.ingredient, a.spice, a.status, a.description
		FROM b_m_products AS a 
		ORDER BY item_id DESC ';
		// SQL文を実行する準備
		$stmt = $dbh->prepare($sql);
	    // SQLを実行
	    $stmt->execute();
	    // レコードの取得
	    $rows = $stmt->fetchAll();
	    // 1行ずつ結果を配列で取得($data[]に格納)
		foreach($rows as $row){
	      $data[] = $row;
	    }
	} catch (PDOException $e) {
		throw $e;
		}
} catch (PDOException $e) {
	  // 接続失敗した場合
	  $err_msg[] = 'DBエラー：'.$e->getMessage();
}
?>

<!DOCTYPE html>
<html lang = "ja">
	<head>
		<meta charset = "UTF-8">
		<title>商品管理画面</title>
		<style>
			table {
				width: 800px;
				border-collapse: collapse;
			}
			table, tr, th, td {
				border: solid 1px;
				padding: 10px;
				text-align: center;
			}
			option:checked {
				color: rgb(3,0,0);
			}
			img{
				max-width: 60px;
				height: 60px;
			}
			.color{
				 background-color:#666666;
			}
		</style>
		<link rel = "stylesheet" href = "best_mariage.css">
	</head>
	<body>
	    <div class = "wrap">
            <div class = "container">
        		<header>
        		   <div class = "top">
                    <p class = "logo">best&nbspmariage</p>
                    <p class = "logopara">~あなたのお料理に合わせてぴったりのワインをご紹介します~</p>
                </div>
        		</header>
        		<section class="addition">
        			<h2>商品管理画面</h2>
        			<h3>新規商品追加</h3>
        			<form method = "post" enctype="multipart/form-data">
        				<?php foreach($err_msg as $err_read){ ?>
        				<p><?php print htmlspecialchars($err_read, ENT_QUOTES, 'UTF-8'); ?></p>
        				<?php } ?>
        				<?php if(count($err_msg) === 0){ ?>
        					<p><?php print htmlspecialchars($result_msg, ENT_QUOTES, 'UTF-8'); ?></p>
        				<?php } ?>
        			
        				<label>商品名: </label>
        				<input type = "text" name = "item_name"><br>
        				<label>本体価格: </label>
        				<input type = "number" name = "price"><br>
        				<label>在庫数: </label>
        				<input type = "number" name = "stock"><br>
        				<div><input type="file" name="new_img"></div>
        				<label>ヴィンテージ: </label>
        				<input type = "number" name = "vintage"><br>
        				<label>ワインの種類: </label>
        				<select name = "wine_kind">
        				    <option value = "0">赤</option>
        				    <option value = "1">白</option>
        				    <option value = "2">ロゼ</option>
        				    <option value = "3">スパークリング</option>
        				</select><br>
        				<label>紐づけする料理のジャンル: </label>
        				<select name = "cooking_kind">
        				    <option value = "0">和食</option>
        				    <option value = "1">イタリアン</option>
        				    <option value = "2">中華</option>
        				    <option value = "3">フランス料理</option>
        				</select><br>
        				<label>食材: </label>
        				<select name = "ingredient">
        				    <option value = "0">肉</option>
        				    <option value = "1">魚</option>
        				</select><br>
        				<label>味付け: </label>
        				<select name = "spice">
        				    <option value = "0">あっさり</option>
        				    <option value = "1">こってり</option>
        				</select><br>
        				<select name = "status">
        					<option value = "0">非公開</option>
        					<option value = "1">公開</option>
        				</select><br>
        				<label>商品説明: </label>
        				<input type = "text" name = "description">
        				<input type= "hidden" name= "process_kind" value = "insert_item">
            		<div><input type="submit" value="商品を追加"></div>
        			</form>
        		</section>
        		<section class="item_info">
        			<h3>商品情報変更</h3>
        			<p>商品一覧</p>
        			<table>
            		<tr>
            			<th>商品画像</th> 
            			<th>商品名</th>
            			<th>本体価格</th>
            			<th>在庫数</th>
            			<th>ヴィンテージ</th>
            			<th>ワインの種類</th>
            			<th>ジャンル</th>
            			<th>食材</th>
            			<th>味付け</th>
            			<th>商品説明</th>
            			<th>ステータス</th>
            			<th>削除</th>
            		</tr>
        				<?php foreach($data as $value){ ?>
        				
        				<tr>
        				<td><img src="<?php print $img_dir . $value['img']; ?>"></td>
        				<td><?php print htmlspecialchars($value['item_name'], ENT_QUOTES, 'UTF-8'); ?></td>
        				<td><?php print htmlspecialchars($value['price'].'円', ENT_QUOTES, 'UTF-8'); ?></td>
        				<td><form method = "post">
        					<input type = "text" name = "stock" value = "<?php print htmlspecialchars($value['stock'], ENT_QUOTES, 'UTF-8'); ?>">個
        					<input type = "submit" name = "submit" value = "変更">
        					<input type = "hidden" name = "process_kind" value = "update_stock">
        					<input type = "hidden" name = "item_id" value = "<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
        					</form></td>
        				<td><?php print htmlspecialchars($value['vintage'].'年', ENT_QUOTES, 'UTF-8'); ?></td>
        	            <td><?php if($value['wine_kind'] === 0){  ?>
        					    <?php print htmlspecialchars('赤', ENT_QUOTES, 'UTF-8'); ?>
        				    <?php }if($value['wine_kind'] === 1){  ?>
        					    <?php print htmlspecialchars('白', ENT_QUOTES, 'UTF-8'); ?>
        					<?php }if($value['wine_kind'] === 2){  ?>
        					    <?php print htmlspecialchars('ロゼ', ENT_QUOTES, 'UTF-8'); ?>
        					<?php }if($value['wine_kind'] === 3){  ?>
        					    <?php print htmlspecialchars('スパークリング', ENT_QUOTES, 'UTF-8'); ?>
        					<?php } ?>
        				</td>
        				<td><?php if($value['cooking_kind'] === 0){  ?>
        					    <?php print htmlspecialchars('和食', ENT_QUOTES, 'UTF-8'); ?>
        				    <?php }if($value['cooking_kind'] === 1){  ?>
        					    <?php print htmlspecialchars('イタリアン', ENT_QUOTES, 'UTF-8'); ?>
        					<?php }if($value['cooking_kind'] === 2){  ?>
        					    <?php print htmlspecialchars('中華', ENT_QUOTES, 'UTF-8'); ?>
        					<?php }if($value['cooking_kind'] === 3){  ?>
        					    <?php print htmlspecialchars('フランス料理', ENT_QUOTES, 'UTF-8'); ?>
        					<?php } ?>
        				</td>
        				<td><?php if($value['ingredient'] === 0){  ?>
        					    <?php print htmlspecialchars('肉', ENT_QUOTES, 'UTF-8'); ?>
        				    <?php }if($value['ingredient'] === 1){  ?>
        					    <?php print htmlspecialchars('魚', ENT_QUOTES, 'UTF-8'); ?>
        					<?php } ?>
        				</td>
        					<td><?php if($value['spice'] === 0){  ?>
        					    <?php print htmlspecialchars('あっさり', ENT_QUOTES, 'UTF-8'); ?>
        				    <?php }if($value['spice'] === 1){  ?>
        					    <?php print htmlspecialchars('こってり', ENT_QUOTES, 'UTF-8'); ?>
        					<?php } ?>
        				</td>
        				<td><?php print htmlspecialchars($value['description'], ENT_QUOTES, 'UTF-8'); ?></td>
        				<td><form method = "post">
        					<?php if($value['status'] === 0){ ?>
        						<input type = "submit" name = "submit" value = "非公開→公開">
        						<input type = "hidden" name = "process_kind" value = "update_status">
        						<input type = "hidden" name = "item_id" value = "<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
        					<?php }if($value['status'] === 1){ ?>
        						<input type = "submit" name = "submit" value = "公開→非公開">
        						<input type = "hidden" name = "process_kind" value = "update_status">
        						<input type = "hidden" name = "item_id" value = "<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
        					<?php } ?>	
        				</form></td>
        				<td><form method = "post">
        				    <input type = "submit" name = "delete" value = "削除">
        				    <input type = "hidden" name = "process_kind" value = "delete">
        				    <input type = "hidden" name = "item_id" value = "<?php print htmlspecialchars($value['item_id'], ENT_QUOTES, 'UTF-8'); ?>">
        				</form></td>
        				<?php } ?>
        			</table>
        		</section>
            </div>
        </div>
	</body>
</html>