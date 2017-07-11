<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php $score = mt_rand(1,6); ?>
<p>サイコロの数字は<?php  print $score ?></p>
    <?php if ($score % 2 === 0) { ?>
    <p>値は偶数<p>
    <?php } else{ ?>
    <p>値は奇数</p>
<?php }?>

</body>
</html>