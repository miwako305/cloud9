<!--ログインページ -->
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>映画飯 [ログイン]</title>
<link rel="stylesheet" href="view/html5reset-1.6.1.css">
<link rel="stylesheet" href="view/movie.css">
<meta name="description"
	content="映画も料理も楽しみたい。映画にまつわる料理をお取り寄せ。いつもは食べないご飯と映画の世界を味わってください">
<meta name="keywords" content="映画,ゲテモノ,面白い,料理,飯,料理,洋画">
<link rel="icon" href="./img/icon/favicon.ico" type="image/png"
	sizes="19x19">
</head>
<style type="text/css">
#heddercontainer, #main {
	background-color: rgb(60, 60, 70);
	margin: 0 auto;
	width: 100%;
	height: auto;
}

#maincontener {
	width: 100%;
	height: 500px;
	display: flex;
}

.login_box {
	flex-grow: 2;
	width:100%;
	flex:2;
}

.login_box_img {
	flex-grow:1;
	  flex:3;
}

.logintop_img {
	display: block;
	margin: 0 auto;
	  flex:1;
}
#formcontainer{
     width:70%;
    display: flex;
    flex:1;
    position: relative;
	top:200px;
	left:30%;
    
}
.login_box_formcontainer{
     width:100%;
    font-size:3em;
    display:flex;
    color:#FFFFCC;
}
label{
    font-size:1em;
    width:35%;
    margin-right: 2%;
    text-align:right;
    display:block;
}
.input_acount{
    font-size:1em;
    display:block;
    width:60%;
    margin-bottom: 3%;
}
.hedder_structure, 
.fotter_structure {
	width: 100%;
}
.ok_bottom{
     width:35%;
     display:block;
     margin:4px;
     font-size:2ex;
     border-radius:8px;
     background-color:red;
     color:white;
     position:relative;
     left:70%;
}
.loginform_link{
     width:50%;
     padding:2%;
     display:block;
     margin:5px;
     font-size:4ex;
     border-radius:8px;
     background-color:#FFFFCC;
     color:black;
     position:relative;
     left:20%;
     top:50%;
     border:solid black;
     text-decoration:none;
    
}

</style>
<body>
	<div id="pagebody">
		<div id="headder">
			<img alt="映画飯ロゴ" src="img/structure/logo.png" width="300"
				height="auto"><br>
			<div id="heddercontainer">
				<img alt="映画飯ヘッダー画" , src="img/structure/hedder.png"
					class="hedder_structure"></img>
			</div>
			確認終了
		</div>
		<div id="main">
			<div id="maincontener">
				<div class="login_box_img">
					<img alt="映画飯TOP画" , src="img/structure/logintop.png"
						class="logintop_img">
				</div>
				<div class="login_box">
					<div id="formcontainer">
							<form method="post">
							    <div class="login_box_formcontainer">
								    <label for="user_name">ユーザ名: </label>
							     	<input type="text" class="input_acount"name="user_name">
								</div>
								<div class="login_box_formcontainer">
								    <label for="userps">  パスワード:</label>
								    <input type="password" class="input_acount" name="userps">
								 </div>
								<div class="login_box_formcontainer">
								    <input type="hidden" name="sql_kind" value="login"> 
								    <input type="submit" value="ログイン" class="ok_bottom">
								</div>
							</form>
					</div>
					<a class="loginform_link" href="loginform.php" >
					  新規のお客様はこちら
					</a>
				</div>
			</div>
		</div>
        <?php if (empty($result_msg) === TRUE) { ?>
        <p>
            <?php print $result_msg; ?>
        </p>
        <?php } ?>
        <?php foreach ($err_msg as $value) { ?>
        <p>
            <?php print $value; ?>
        </p>
        <?php } ?>
        <img alt="映画飯フッター画画" , src="img/structure/fotter.png"
			class="fotter_structure"></img>
		<tr>
	
	</div>
</body>
</html>