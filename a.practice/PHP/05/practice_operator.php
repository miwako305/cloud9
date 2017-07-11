<?php
$apple = 100;
$grape = 150;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>演算子の課題</title>
</head>
<body>

<?php 
   $price =($apple*3 + $grape*2)*1.08;
?>
<p> 合計：<?php print $price ;  ?><p>
</body>
</html>