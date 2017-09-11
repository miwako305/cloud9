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
        max-width:980px;
    }
#login_box {
        padding: 0;
        margin: 0 auto;
        font-size: 2ex;
        height: 600px;
        width: 800px;
    }
    #headder{
          margin: 0 auto; 
          padding:0;
          height: 200px;
    } 

#login-inform{
    margin:0 auto;
    width:50%;
}
#login_box{
    font-size:0.75em;
display:block;
float: left;
width:140px;
border-radius: 15px;
}

</style>
<body>
    <div id="pagebody">
        <div id="headder">
            <table div="heddercontainer">
                    <img src="img/structure/logo.png" width="500" height="auto"><br>
                    <td>
                        <a class="headertitle">
                            <h1>新規登録画面</h1>
                        </a>
                    </td>
            </table>
        </div>
        <div id="main">
            <div id="maincontener">
                <div id="login_box">
                    <table id="inform">
                        <form method="post" id="login-inform">
                            <label for="user_name">
                                    <a>ユーザ名:</a>
                                    <input type="text" class="block" name="user_name">
                             </label>
                            <label for="userps">
                                   <a>パスワード:</a>
                                    <input type="password" class="block" name="userps">
                             </label>
                            <label for="user_adress">
                                      <a>住所:</a>
                                      <input type="text" class="block" name="user_adress">
                             </label>
                            <label for="user_mail">
                                     <a>メールアドレス:</a>
                                    <input type="text" class="block" name="user_mail">
                             </label>
                            <label for="user_phone">
                                <a>電話番号:;</a>
                                <input type="text" class="block" name="user_phone">
                             </label>
                            <input type="hidden" name="sql_kind" value="login">
                            <input type="submit" value="新規登録">
                        </form>
                    </table>
                </div>
            </div>
        <a class="backme" href="login.php"> ログイン画面に戻る</a>
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
        </div>
    </div>
</body>

</html>
