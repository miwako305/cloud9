<?php $class = ['ガリ勉' => '鈴木', '委員長' => '佐藤', 'セレブ' => '斎藤', 'メガネ' => '伊藤', '女神' => '杉内'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?PHP
foreach ($class as $key => $class) { ?>
<p>　<?php  print $class; ?>さんのあだ名は<?php print $key; ?>

<?php
}
?>
</body>
</html>