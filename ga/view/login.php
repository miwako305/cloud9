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
<body>
    <div id="pagebody">
        <div id="headder">
            <table div ="heddercontainer" >
                <td>
                    <img src = "img/structure/logo.png"  width="300" height="auto"><br>
                    <img alt="映画飯ヘッダー画", src="img/structure/hedder.png"></img>
                </td>
           </table>
        </div>
        <div id="main">
            <div class ="maincontener">
                <th>
                <img   alt="映画飯TOP画", src="img/structure/logintop.png"  >
                </th>
                        <div id="login_box">
                            <table id ="formcontainer" >
                                <td width ="250">
                                     <form  method="post" id ="formcontainer" >
                                         <label for="user_name">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ユーザ名:&nbsp;</label<>
                                         </a><input type="text" class="block" name="user_name">
                                         <label for="userps">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;パスワード:</label>
                                         </a><input type="password" class="block"  name="userps" >
                                         </a><input type="hidden" name="sql_kind" value="login">
                                         </a><input type="submit" value="ログイン">
                                    </form>
                                    <div class="loginform.php">
                                        <form action="loginform.php">
                                            <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> <input type="submit" value="新規のお客様はこちらから">
                                         </form>
                                    </div>
                                </td>
                            </table>
                        </div>
                    </div>
                </div>


    <?php if (empty($result_msg) === TRUE) { ?>
    <p><?php print $result_msg; ?></p>
     <?php } ?>
    <?php foreach ($err_msg as $value) { ?>
    <p><?php print $value; ?></p>

    <?php } ?>
  
 <img alt="映画飯ヘッダー画", src="img/structure/fotter.png"></img>    
 <tr>
</div>                 

</body>
</html>
