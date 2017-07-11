
<?php
$rand = mt_rand(1,10);//1~10の値をランダムに習得
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<抽選システム>
<p>値は：<?php print $rand; ?></p>
<?php if ($rand <= 3) { ?>
<p>当たり！</p>
<? php }else{ ?>
<p>残念でした・・・また引いてね。</p>
<?php } ?>
</body>
</html>
