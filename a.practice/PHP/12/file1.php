<?php
$filename ='./file_write.text';

if ($_SERVER['REQUEST_METHOD'] ==='POST'){
  $comment = $_POST['coment']."\n";
  if (($fp = fopen($filename ,'a')) !== FALSE){
    if (fwrite($fp, $comment) === FALSE) {
 print'ファイル書き込み失敗:  '.$failename;
    }
    fclose($fp);
  }
}
$data = [];

if (is_readable($filename) === TRUE) {
    if (($fp =fopen($filename, 'r')) !== FALSE){
    while(($tmp = fgets($fp)) !==FALSE) {
        $data[] = htmlspecialchars($tmp,ENT_QUOTES, 'utf-8');
    }
        fclose($fp);
    }
} else {
    $data[] ='ファイルがありません';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>ファイル操作</title>
</head>
<body> 
<h1>ファイル操作</h1>
<form method = "post">
<input type = "text" name = "coment">
<input type = "submit" name ="submit" value="送信">
</form>
<P>以下に<?php print $filename ; ?>の中身を表示</P>
<?php foreach ($data as $read) { ?>
<p> <?php print $read; ?></p>

<?php }?>
</body>
</html>