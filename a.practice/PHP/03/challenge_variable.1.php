
<?php
$name = '松尾美和子';
$address='東京都新宿区';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>変数の使用例</title>
</head>
<body>
    <h1>変数の使用例</h1>
    <p>ようこそ<?php  print $name; ?>
    <p>住所は<?php print $address; ?></p>
    <ul>
    <li><a href='#'><?php print $name; ?>さんのマイページをみる</a></li>
    </ul>
</body>
</html>