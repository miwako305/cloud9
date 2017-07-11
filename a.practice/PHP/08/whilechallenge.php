<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ループ処理</title>
</head>
<script>
</script>
<body>
<?php
$i = 1;
$sum = 0;

 while ($i <= 100){
      if ($i % 3 === 0){
     $sum += $i;
      }
      $i++;
}
print "合計" .$sum ."\n" ;
?>

</body>
</html>