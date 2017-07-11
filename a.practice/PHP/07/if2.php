<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php
$int = 123;  //整数型
$str = '123';//文字型
//値のみを比較
if ($int == $str) {
print '$int == $str is true'."\n"; 
}else{
print '$int == $str is false'."\n"; 
}
//値と型を比較
if ($int === $str){
print '$int ===$str is true' . "\n";
}else{
    print '$int===$str false '."\n";
}
?>
</body>
</html>
