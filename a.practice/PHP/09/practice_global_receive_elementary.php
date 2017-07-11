
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title></title>
</head>

<body>
<?php
if(isset($_POST['my_name'])===TRUE){
    print 'ようこそ' . htmlspecialchars($_POST['my_name'], ENT_QUOTES,'UTF-8') . 'さん';
} else {
    print'名無しさん';
}
?>
</body>
</html>