<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>映画飯{管理}</title>
<link rel="stylesheet" href="html5reset-1.6.1.css">
<link rel="stylesheet" href="view/movie.css">
<link rel="icon" href="./img/icon/favicon.ico" type="image/png" sizes="18x18">
<meta name="description" content="いつもの食卓をちょっぴり豪勢に！主婦からの投稿が多いので、誰でも作れる簡単レシピが沢山掲載されております！">
<meta name="keywords" content="CookCamp,クックキャンプ,レシピ,献立,簡単,料理,recipe">

<title>[管理飯]</title>
<style>
.status_false {
	background-color: #A9A9A9;
}

.now_item {
	display: block;
	font-size: 0.6ex;
	text-align: left;
	width: 500px;
	margin-bottom:0;
}

a.now_item {
	display:inline-block;
	font-size: 0.5ex;
	text-align: left;
	width: 100px;
	margin: 0;
	padding: 0px;
}

section {
	margin-bottom: 20px;
	border-top: solid 1px;
	width: 800px;
}

table {
	border-collapse: collapse;
	text-align: left;
}

tr {
	border-bottom: solid 1px;
	text-align: center;
}

caption {
	text-align: left;
}

.text_align_right {
	text-align: right;
}

.item_name_width {
	width: 100px;
}

.input_text_name_width {
	width: 300px;
}

.input_text_price_width {
	width: 100px;
}

.input_text_stock_width {
	width: 100px;
}
</style>
</head>

<body>
    <?php if (empty($result_msg) !== TRUE) { ?>
    <p>
        <?php print $result_msg; ?>
    </p>
    <?php } ?>
    <?php foreach ($err_msg as $value) { ?>
    <p>
        <?php print $value; ?>
    </p>
    <?php } ?>
    <h1>商品管理ツール</h1>
	<section>
		<h2>新規商品追加</h2>
		<form method="post" enctype="multipart/form-data">
			<div>
				<label>名前: <input type="text" name="new_name" value=""></label>
			</div>
			<div>
				<label>値段: <input type="text" name="new_price" value=""></label>
			</div>
			<div>
				<label>個数: <input type="text" name="new_stock" value=""></label>
			</div>
			<div>
				<input type="file" name="new_img">
			</div>
			<input type="hidden" name="sql_kind" value="insert">
			<div>
				<label>ステータス： <select name="new_status">
						<option value="0">非公開</option>
						<option value="1">公開</option>
				</select></label>
			</div>
			<div>
				<input type="submit" value="商品を追加">
			</div>
		</form>
	</section>
	<section>
		<table>
			<caption>商品情報</caption>
			<tr>
				<th>登録商品情報</th>
				<th>画像</th>
				<th>商品名</th>
				<th>価格</th>
				<th>在庫数</th>
				<th>削除</th>
				<th>公開</th>
			</tr>
            <?php foreach ($data as $value)  { ?>
            <?php if ( $value['status'] === '1' ) { ?>
            <tr>
                <?php } else { ?>

			
			
			
			<tr class="status_false">
                    <?php } ?>
                <th class="now_item"><img
					src="<?php print $img_dir . $value['img']; ?>" height="100"
					width="100"></br> <a class="now_item">商品名:</a><a><?php print $value['item_name']; ?></a></br>
					<a class="now_item">商品価格：<?php print $value['price']; ?>円</a> </br>
					<a class="now_item">商品在庫：<?php print $value['stock']; ?>個</a></th>
				<th>
					<form method="post" enctype="multipart/form-data">
						<input type="file" name="update_img" img
							src="<?php print $img_dir . $value['img']; ?>"> <input
							type="hidden" name="sql_kind" value="update_img"> <input
							type="hidden" name="item_id"
							value="<?php print $value['item_id']; ?>">
						<div>
							<input type="submit" value="画像を変更">
						</div>
					</form>
				</th>
				<th>
					<form method="post">
						<input type="text" class="input_text_name_width"
							name="update_name"> &nbsp;&nbsp; <input type="submit" value="商品名変更">
						<input type="hidden" name="sql_kind" value="update_item_name"> <input
							type="hidden" name="item_id"
							value="<?php print $value['item_id']; ?>">
					</form>
				</th>
				<th>
					<form method="post">
						<input type="text" class="input_text_price_width"
							name="update_price" value="<?php print $value['price']; ?>">円<input
							type="submit" value="価格名変更"> <input type="hidden" name="item_id"
							value="<?php print $value['item_id']; ?>"> <input type="hidden"
							name="sql_kind" value="update_price">
					</form>
				</th>
				<th>
					<form method="post">
						<input type="text" class="input_text_stock_width" name="update_stock" value="<?php print $value['stock']; ?>">個
						<input type="submit" value="在庫変更"> 
						<input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>"> 
						<input type="hidden" name="sql_kind" value="update_stock">
					</form>
				</th>
				<th>
					<form method="post">
						<input type="submit" value="削除"> 
						<input type="hidden" name="sql_kind" value="delete"> 
						<input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
					</form>
				</th>
				<th>
                        <?php if ( $value['status'] === '1' ) { ?>
                    <form method="post">
						<input type="submit" value="公開→非公開"> 
						<input type="hidden" name="sql_kind" value="change"> 
						<input type="hidden" name="change_status" value="0"> 
						<input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
					</form>
                        <?php } elseif ( $value['status'] === '0' ) { ?>
                    <form method="post">
						<input type="submit" value="非公開→公開"> <input type="hidden" name="sql_kind" value="change"> 
						<input type="hidden" name="change_status" value="1"> 
						<input type="hidden" name="item_id" value="<?php print $value['item_id']; ?>">
					</form>

				</th>
			</tr>

                <?php  } } ?>
        </table>
	</section>
</body>

</html>
