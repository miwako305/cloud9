<!DOCTYPE html>
<html lang="ja">
<head>
<title></title>
<meta charset="utf-8">
</head>
<body>
<pre>
<?php
$score1 = mt_rand(0,100);
$score2 = mt_rand(0,100);
$sum = $score2 +$sum1;

  print 'score1: ' . $score1 . "\n";
  print 'score2:' . $score2 . "\n";
  print 'sum:' . $sum . "\n";
//合計が１６０以上またはscore1かscore2が40以上
if($sum >= 160 || $score1===100 || $score2 ===100){
    print '特待生'. "\n";
//合計が１２０以上かつscore1とscore2が40以上
}else if ($sum >= 120 && $score1>=40 && $score2>=40 ){
 print '合格' ."\n";
 //条件外
}else{
    print '不合格' ."\n";

}
?>
</pre>
</body>
</html>
