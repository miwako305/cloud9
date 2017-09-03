<!--ログインページ -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>映画飯 [ログイン]</title>
    <link rel="stylesheet" href="view/html5reset-1.6.1.css">
    <link rel="stylesheet" href="view/movie.css">
    <meta name="description" content="映画も料理も楽しみたい。映画にまつわる料理をお取り寄せ。いつもは食べないご飯と映画の世界を味わってください">
    <meta name="keywords" content="映画,ゲテモノ,面白い,料理,飯,料理,洋画">
    <link rel="icon" href="./img/icon/favicon.ico" type="image/png" sizes="19x19">
</head>
<style type="text/css">
    #main{
background-color:rgb(60, 60, 70);
margin:0 auto;
width:100%;
height:auto;
}

</style>
<body>
    <div id="pagebody">
        <div id="headder">
            <table div="heddercontainer">
                <td>
                    <img src="img/structure/logo.png" width="300" height="auto"><br>
                    <img alt="映画飯ヘッダー画" , src="img/structure/hedder.png" width="2000" height="auto"></img>
                </td>
            </table>
        </div>
        <div id="main">
            <div class="maincontener">
                    <img alt="映画飯TOP画" , src="img/structure/logintop.png">
                <div id="login_box">
                    <table id="formcontainer">
                        <td width="250">
                            <form method="post" id="formcontainer">
                                <label for="user_name">ユーザ名:
                                     <a><input type="text" class="block" name="user_name"></a>
                                 </label>
                                 <label for="userps">
                                     <a> パスワード:</a>
                                     <input type="password" class="block" name="userps">
                                 </label>
                                 <input type="hidden" name="sql_kind" value="login">
                                 <input type="submit" value="ログイン">
                            </form>
                            <div class="loginform.php">
                                <form action="loginform.php">
                                    <input type="submit" value="新規のお客様はこちらから">
                                </form>
                            </div>
                        </td>
                    </table>
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
<<<<<<< HEAD
        <img alt="映画飯ヘッダー画" , src="img/structure/fotter.png" width="2000"></img>
=======
        <img alt="映画飯ヘッダー画" , src="img/structure/fotter.png" width= "2000"></img>
>>>>>>> 48365b6... コミットメッセージ
        <tr>
    </div>
</body>
</html>
