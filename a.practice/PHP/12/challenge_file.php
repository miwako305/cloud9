<?php

$filename = './file_write.txt';
$log = date ('Y-m-d  H:i:s')."\t";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  $comment = $_POST['comment']. "\n";
  if(($fp = fopen($filename, 'a')) !== FALSE){
  if (fwrite($fp, $log . "\t" . $comment . "\r\n") === FALSE){
  print 'ファイル書き込み失敗：'.$failname;
  }

  fclose($fp);
}


$data =[];


if(($fp = fopen($filename , 'r')) !== FALSE) {
    while (($tmp =fgets($fp)) !==FALSE){
$data[] = htmlspecialchars($tmp,ENT_QUOTES,"UTF-8");
}
fclose($fp);
}
}else{
    $data[] = 'ファイルがありません';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
      <meta charset="UTF-8">
<title>ファイル操作</title>
</head>
<body>  

 <h1>ファイル書き込み</h1>
  <form method ="post">
 <a>発言： 
  <input type ="text" name="comment">
 </a> 
  <input type="submit" name"subumit" value="送信">
  
</form>
<p>発言一覧</p>

<?php foreach ($data as $read) { ?> 
  <p><?php print $read ;?>  </p>

  
<?php  } ?>
</body>
</html>