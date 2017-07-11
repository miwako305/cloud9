<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
</head>

<body>

<?php
//0~2のランダムな数値を二つ取得し、それぞれ変数$rand1と$rand2へ代入
$rand1 = mt_rand(0 ,2 );
$rand2 = mt_rand(0 ,2 );

//ランダムな数値と＄rand1と＄rand2をそれぞれ表示
print 'rand1: ' . $rand1 . "\n";
print 'rand2: ' . $rand2 . "\n";

//rand1とrand2を比較し大きい方の結果を表示rand2
?>
<p>大きい方は<?php print $big ;?></p>
     <?php if ( $rand1 > $rand2 ){?>
     <p>rand1の方がでかい</p>
     <?php } else if ($rand2 > $rand1) {?>
     <p>"rand2の方がでかい"</p>
     <?php } else{?>
     <p> どっちも一緒</p>
     <?PHP } ?>
</body>
</html>