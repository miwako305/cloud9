<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>条件分岐</title>
</head>
<body>
<?php
$rand = mt_rand(1,10);
print 'rand';
//６以上の場合
if ( $rand >= 6) {
    print '当たり';
}else {
    print 'ハズレ';
}
?>
</body>
</html>
