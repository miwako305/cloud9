<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>映画飯 [新規登録]</title>
<link rel="stylesheet" href="view/html5reset-1.6.1.css">
<!--link rel="stylesheet" href="view/movie.css" -->
<meta name="description"
	content="映画も料理も楽しみたい。映画にまつわる料理をお取り寄せ。いつもは食べないご飯と映画の世界を味わってください">
<meta name="keywords" content="映画,ゲテモノ,面白い,料理,飯,料理,洋画">
<link rel="icon" href="./img/icon/favicon.ico" type="image/png"
	sizes="19x19">
</head>
<body>
	<div id="pagebody">
		<div id="headder">
			<table div="heddercontainer">
				<tr><td>
					     <img src="img/structure/logo.png" width="300" height="auto">
					</td>
					<td>
						<h1>新規登録画面</h1> <a class="headertitle"> </a>
					</td>
				</tr>
			</table>
		</div>
		<div id="main">
			<div id="maincontener">
				<div id="login_box">
					<a> </a>
					<form method="post" id="login-inform">
						<table id="inform">
							<tr>
								<label for="user_name">ユーザ名:</label<>
								<input type="text" class="block" name="user_name">
								<br>
								<label for="userps">パスワード:</a></label>
								<input type="password" class="block" name="userps">
								<input type="hidden" name="sql_kind" value="login">
								<input type="submit" value="新規登録">
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div>
        <?php if (empty($result_msg) !== TRUE) { ?>
        <p>
            <?php print $result_msg; ?>
        </p>
		<p>
            <?php print '名前：'. $user_name; ?>
        </p>
		<p>
            <?php print 'パスワード：'. $userps; ?>
        </p>
        <?php } ?>
        <?php foreach ($err_msg as $value) { ?>
        <p>
            <?php print $value; ?>
        </p>
		<p>
            <?php print $user_name; ?>
        </p>
		<p>
            <?php print $userps; ?>
        </p>
        <?php } ?>
    </div>
<a class="backme" href="login.php"> ログイン画面に戻る</a>
</body>

</html>
