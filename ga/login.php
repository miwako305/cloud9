<?php
/* 最終課題の会員登録ページ */
session_start();
// データベースの接続情報

define('DB_USER',   'miwako305');    // MySQLのユーザ名
define('DB_PASSWD', '');    // MySQLのパスワード
define('DSN', 'mysql:dbname=ga;host=localhost;charset=utf8');  

   $date = [];
   $err_msg = [];  // エラーメッセージ用の配列
   $result_msg = '';// 実行結果のメッセージ
    
    
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $user_name = ''; //初期化
    $userps = '';
    //今見えていますか？login.phpですおっとこちらにいましたね＾＾
    //まず、先ほどのユーザー登録ができないエラーはloginform.phpの69行目が原因です。見て見ますね移動しましょう。はい
    if (isset($_POST['user_name']) === TRUE) { //issetでのチェック
      $user_name = preg_replace('/^[\s　]+|[\s　]+$/u','', $_POST['user_name']);  //全角と半角の空白を取り除く。受け取り
    }
    //ここからエラーチェック
    if($user_name === ''){ //未入力チェック
        $err_msg[] = 'ユーザー名を入力してください。';
    }else if(preg_match('/^[a-z\d_]{6,20}$/i', $_POST['userps'])!== 1){ //正規表現チェック
        $err_msg[] = "ユーザー名は半角英数字6文字以上でご入力ください。";
    }
    
    if (isset($_POST['userps']) === TRUE) { //issetでのチェック
      $userps = preg_replace('/^[\s　]+|[\s ]+$/u','', $_POST['userps']); //全角と半角の空白を取り除く。受け取り
    }
    
    //ここからエラーチェック
    if($userps === ''){ //未入力チェック
        $err_msg[] = 'パスワードを入力してください。';
    }elseif(preg_match('/^[a-z\d_]{6,20}$/i', $_POST['userps']) !== 1){ //正規表現チェック
        $err_msg[] = "パスワードは半角英数字6文字以上でご入力ください。";
    }
  }
  
  // DB接続前にcount($err_msg)をチェック
  if (count($err_msg) === 0 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    
   try {
     // データベースに接続
     $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
     $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     
     // 現在日時を取得
     $created_at = date('Y-m-d H:i:s');
     $user_id="";
     // select文で重複ユーザーの確認
     //はい、そうですね。それに伴ってこう変わります。ではもう一度ログインして見ましょう。はい
     //入れましたか？hairemashita^_^hai
     //オッケーです＾＾ではtopmenu.phpの上部に移動しましょう！
    $sql = 'SELECT
            user_id 
            FROM users
            WHERE user_name= ? AND userps = ?' ;
    $stmt = $dbh->prepare($sql);
        $stmt->bindValue(1, $user_name,    PDO::PARAM_INT);
        $stmt->bindValue(2, $userps,        PDO::PARAM_INT);
        // $stmt->bindValue(1, $user_id,        PDO::PARAM_INT);
    // SQLを実行
    $stmt->execute();
    // レコードの取得
    $rows = $stmt->fetchAll();
    // 1行ずつ結果を配列で取得します
    //はい、こちらですね＾＾
       //user_idをセッションに格納して使い回すことはできますか？
     //はい可能ですが、ここの処理の仕方が違います。
    //まず、$rowsに実行結果が１行以上あればというif文は
    //if(count($rows) >= 1){ となります。書き換えて見ましょう！
    // はい、そうですね！その上で、今は最初が失敗の分岐になっているのでちょっと入れ替えます。
    //こうですね。またセッションはプログラムの最初で始めるものですので
    //79行目の記載は、3行目に移動しましょう。
    //はい、オッケーです。次にユーザーIDをセッションに格納します。これは
    //$_SESSION['user_id'] = $rows[0]['user_id'];//なるほど。
    //$_SESSION['user_id']= $user_id;これでも、入れるには入れたのですがエラーが起きやすいですか？
    //これは、ログイン処理ができていません。$_SESSION['user_id']にuser_idを保存するのがログイン処理の目的です。
    //セッションにuser_idを保存することで次以降のページでuser_idの値を使い回すためにログインしています。
    //わかりました
    //となります。fetchAllで取得した結果の１行目にユーザーデータが入っているので、
    //その中のuser_idの値を取得するのです。$rows[0]['user_id']とはそういう意味です。
       //パスワードは次以降のページでは使いませんので、セッションに保存する必要はありません。91行目が不要です。
     //そうですね。次に90行目の部分は何のためのものですか？
     // select文の実行結果が１行以上あればエラーメッセージを表示
     //なるほど、これは「ユーザーIDがセッションに保存されているか」すなわちログインされているかどうかを
     //チェックするものですね。
     //ですのでこれはこのようになります。user_idがセッションに保存されていなければ、ログイン画面に
     //飛ばすことになります。
     //また、リンクをプリントしなくてもこれでオッケーです。自動的にlogin.phpにリダイレクトされます。
     //これをログイン後の各画面に貼り付ければオッケーです。ただしセッションが始まっていないといけないので、
     //ここが必要です。(すでにsession_start()があれば二重に行う必要はありませんが）
     //ここまではいかがですか？はい
     //理解できましたか？はいありがとうございます＾＿＾
     //はい＾＾では続きに行きましょう。
     //時間なくなってきたのでスピードアップします。よろしくお願いします
     //ログインチェック
        // session_start();
        // if(isset($_SESSION['user_id']) == false){
        //     header('Location: login.php');
        //     exit(); 
        // }
     ///と行った形で、セッションの処理を行なっているのですが
        if (count($rows) >= 1) {
            //  $result_msg = 'ログイン成功';リダイレクトしたら、変数は使えないので、ここは不要です。
             //どうしましたか？新規でログインできるか見て見たところ、新しいPSでもすでに」登録されているとでてしまいます
             //なるほど、チェックしましょう。ただ、それは新規ログインではなく、
             //ユーザー登録ではありませんか？
            //   $user_id=$row[3];ここは110行目あるので不要です。
            //   $_SESSION['login']=1;ここもこれで不要になります。先ほどのチェックが書かれていた点はこちらに直しましょう。
            $_SESSION['user_name']= $user_name;//ここも本来不要ですが、害がなさそうなので一応残します。
            $_SESSION['user_id'] = $rows[0]['user_id'];
            header('Location: topmenu.php');
            exit();//header関数によるリダイレクトは、exitを必ずワンセットでつける必要があります。
        }else{
        //   $result_msg = 'ログイン失敗' ;ここも同様です。
           header('Location: login.php');
           exit();//ここはワンセットになります。
        //   あとは、ログイン後のページでログインチェックを直さないとログインしたあと
        //   チェックで弾かれてしまいます。topmenu.phpの上部に移動しましょう。　//
        }  
}  catch (PDOException $e) {
     $err_msg[] = '予期せぬエラーが発生しました。管理者へお問い合わせください。'.$e->getMessage();
    //  header('Location: login.php');ここは何もする必要はありません。
}

}
// テンプレートファイル読み込み
include_once './view/login.php';
    