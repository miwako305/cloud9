
<?php
$name = '松尾美和子';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title>変数の使用例</title>
</head>
<body>
    <pre>
    <?php 
     $test_str = 'これは変数です。';
     print "ダブルクォート: $test_str";
     print "\n";
     print 'シングルクォート:$test_str';
     print '\n';
    ?>
    
    </pre>
</body>
</html>