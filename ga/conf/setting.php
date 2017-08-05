<?php>
$subject = 'CodeCamp';
    $pattern = '/^[a-zA-Z]+$/';
    // 左に検索するパターンを記述してください
    if (preg_match($pattern, $subject) ) {
      print $subject.'は、半角英字です。';
    } else {
      print $subject.'は、半角英字ではありません。';
    }
    print '<br>';
    
    include_once'view/login.php';
    