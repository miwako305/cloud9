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
$sum=0;
for( $i = 0; $i<100; $i++) {
if ($i%3  === 0){
    $sum += $i;
   }
}
print '合計' . $sum ;
?>
</body>
</html>