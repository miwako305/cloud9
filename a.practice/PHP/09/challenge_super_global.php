<?php 
//変動初期化
$gender = "";
$name ="";
$checkbox ="";
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
 if (isset ($_POST ['gender']) === TRUE){
          $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES, 'UTF-8');
}
 if (isset ($_POST ['my_name']) === TRUE){
          $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
} if (isset ($_POST ['checkbox']) === TRUE){
          $checkbox= htmlspecialchars($_POST['checkbox'], ENT_QUOTES, 'UTF-8');
}
} ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>スーパーグローバル変数課題1</title>
</head>
<body>
<h1>課題<h1>
<?php
if ( isset ($_POST['my_name']) === TRUE){
    print '名前:' .htmlspecialchars($_POST['my_name'], ENT_QUOTES,'UTF-8');
} else {
    print '名前が送られていません';
}
?>
<h2>性別を選択してください</h2>
<?php
if (isset ($_POST['gender']) === TRUE){
if ($gender === '男' || $gender === '女' ) { ?>
<p>性別:<?php print $gender; ?></p>
<?php }} ?>

<h2>メールの受信設定</h2>
<?php
if(isset($_POST['checkbox']) === TRUE){ ?>
 <P><?php print $checkbox; ?> </P> 
<?php } ?>
    
<h1>メールの送信フォーム</h1>    
<form method ="post">
    <input type="text" name="my_name" value="お名前"<?php print "my_name"; ?><br>
    <input type = "radio" name = "gender" value = "男" <?php if ($gender === '男') {print 'checked' ; } ?>>男
    <input type = "radio" name = "gender" value = "女" <?php if ($gender === '女') {print 'checked' ; } ?>>女<br>
    <input type="checkbox" name="checkbox"  value="OK">お知らせメールを受け取る" <br>
    <input type="submit" value="送信"><br>
</form>
</body>
</html>