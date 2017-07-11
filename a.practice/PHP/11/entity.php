<?php
$h1 = '「<h1>見出し</h1>は見出しを表します。';
$p = '「<p>段落</p>は段落を表します。';
$li = '「<li>リスト項目</li>はリスト項目を表します。';

///特殊文字をHTMLエンティティーに変換///
$h1 =entity($h1);
$p =entity($p);
$li =entity($li);

function entity($str) {
return htmlspecialchars ($str ,ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>htmlエンティティ</title>
</head>
<body>    
<h1><?php print $h1; ?></h1>
<p><?php print $p; ?></p>
<li><?php print $li; ?></li>
</body>
</html>