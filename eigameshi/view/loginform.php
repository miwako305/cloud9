<!--新規登録ページ-->
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
<style type="text/css">
h1{
    font-size:3ex; 
}

.atention_msg{
font-size:4ex;

    
}
#pagebody {
	margin: 0 auto;
	width: 100%;
	
}
#headder {
	margin: 0 auto;
	padding: 0;
	height: 130px;
	border-bottom:#800020 30px;
	border-style: solid ;

}
#headdercontainer{
	margin: 0 auto;
	padding: 0;
	width:80%;
	height: 130px;
}

#maincontener {
	width:980px;
	margin:0 auto;
	display:flex;
}

#login_box {
	padding-top:0.5%;
	margin-top:5%;
	height:90%;
	width:65%;
	flex:3;
    background-color:#FFFFCC;
}



#login-inform {
	margin: 0 auto;
	width: 90%;
	height: 70%;
}

.login-inform-box {
	margin:5%;
	width:95%;
	height:70%;
	flex:3;
	display:flex;
}
label{
    font-size:1.8em;
    width:20%;
    margin-right: 2%;
    text-align:right;
    display:block;
}
.input_text {
	font-size:3ex;
	display:block;
	height:20px;
	
}
.user_adress{
    width:75%;
}

.ok_bottom{
     width:20%;
     display:block;
     margin:5px;
     font-size:3ex;
     border-radius:8px;
     background-color:red;
     color:white;
     position:relative;
     left:70%;
}
.backme{
    display:block;
    font-size:2.5ex;
    flex:2;
    text-align:right;
    vertical-align:text-bottom;
    position:relative;
    bottom:-90%;
}
#login_result_msg{
    font-size:1.5ex;
     margin-top:10%;
     border:solid #800020 1em;
     padding:5%;
     list-style-image: url("img/icon/AttentionTriangle.png");
     flex:1.5;
}
#fotter{
    border-bottom:#800020 30px;
	border-style: solid ;
	margin-top:100px;
	
}
</style>
<body>
<div id="pagebody">
    <div id ="headder">
        <div id ="headdercontainer">
            <img src ="img/structure/logo.png" width="200" height="auto" >
            <h1>新規登録画面</h1>
        </div>
    </div>
    <div id="maincontener">
        <div id ="login_box">
            <div id="inform">
                <form method="post">
                    	<div class="login-inform-box">
							<label for="user_name"> ユーザ名: </label> <input type="text"
								class="input_text" name="user_name">
						</div>
						<div class="login-inform-box">
							<label for="userps">パスワード:</label> <input type="password"
								class="input_text" name="userps">
						</div>
						<div class="login-inform-box" >
							<label for="user_adress"> 住所:</label> <input type="text"
								class="input_text user_adress" name="user_adress">
						</div>
						<div class="login-inform-box">
							<label for="user_mail"> メールアドレス: </label> 
							<input type="text" class="input_text" name="user_mail">
						</div>
						<div class="login-inform-box">
							<label for="user_phone"> 電話番号:</label> <input type="text"
								class="input_text" name="user_phone">
						</div>
						<div class="login-inform-box">
							<input type="hidden" name="sql_kind" value="login">
							<input type="submit" value="新規登録" class = "ok_bottom">
						</div>
                </form>
            </div>
        </div>
        <div id="back_me">
            	<a class="backme" href="login.php"> ログイン画面に戻る</a>
        </div></br>
        <?php if (empty($result_msg) !== TRUE) { ?>
         <div id="login_result_msg">
            <p> <?php print '！'.$result_msg; ?></p>
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
             </div>
            <?php }elseif (empty($err_msg) !== TRUE){ ?>
             <div id="login_result_msg">
            <p class="atention_msg">登録できませんでした。</p>
            <?php foreach ($err_msg as $value) { ?>
             <li>
                <?php print $value; ?>
            </li>
            <?php } } ?>
        </div>
            
    </div>
    <div id="fotter">
    </div>
</div>
<?php var_dump($user_mail); ?>
<?php var_dump($user_name); ?>
<?php var_dump($user_adress); ?>
<?php var_dump($_POST); ?>
</body>
</html>
