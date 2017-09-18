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
<style>
#pagebody {
	margin: 0 auto;
	font-size: 2ex;
	max-width: 980px;
	height: 900px;
	position: relative;
}
#maincontener{
    margin: 0 auto;
    max-width: 980px;
	height: 900px;
}

#login_box {
	padding: 0;
	margin: 0 auto;
	font-size: 2ex;
	height: 600px;
	width: 800px;
}

#headder {
	margin: 0 auto;
	padding: 0;
	height: 200px;
}

.headertitle {
	width: 80%;
	height: 180px;
}

#login-inform {
	margin: 0 auto;
	width: 80%;
	height: 600px;
}

#login-inform-box {
	margin: 30px;
	width: 90%;
	padding-bottom: 30px;
}

.block {
	font-size: 2ex;
}
</style>
<body>
	<div id="pagebody">
		<div id="headder">
			<div="heddercontainer">
				<img src="img/structure/logo.png" width="500" height="auto"><br>
				<h1>新規登録画面</h1>
			</div>
		</div>
		<div id="maincontener">
			<div id="login_box">
				<div class="inform">
					<form method="post" id="login-inform">
						<div class="login-inform-box">
							<label for="user_name"> ユーザ名: </label> <input type="text"
								class="block" name="user_name">

						</div>
						<div class="login-inform-box">
							<label for="userps">パスワード:</label> <input type="password"
								class="block" name="userps">
						</div>
						<div class="login-inform-box">
							<label for="user_adress"> 住所:</label> <input type="text"
								class="block" name="user_adress">
						</div>
						<div class="login-inform-box">
							<label for="user_mail"> メールアドレス: </label> <input type="text"
								class="block" name="user_mail">
						</div>
						<div class="login-inform-box">
							<label for="user_phone"> 電話番号:</label> <input type="text"
								class="block" name="user_phone">
						</div>
						<div class="login-inform-box">
							<input type="hidden" name="sql_kind" value="login"> <input
								type="submit" value="新規登録">
						</div>
					</form>
				</div>
			</div>
		</div>
		<a class="backme" href="login.php"> ログイン画面に戻る</a>
            <?php if (empty($result_msg) !== TRUE) { ?>
            <p>
                <?php print $result_msg; ?>
            </p>
		<div>
			<a>
                <?php print '名前：'. $user_name; ?>
            </a>
			<p>
                <?php print 'パスワード：'. $userps; ?>
            </p>
			<p>
                <?php print '電話番号：'. $user_phone; ?>
            </p>
			<p>
                <?php print 'メールアドレス：'. $user_mail; ?>
            </p>
			<p>
                <?php print '住所：'. $user_adress; ?>
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
	</div>
</body>
</html>
