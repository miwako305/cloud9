<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>スコープ</title>
  </head>
  <body>
  <?php
  

    function test_scope() {
        $str = 'スコープテスト'; // 関数外で変数定義(グローバル変数)
      print $str; // 関数内の変数を参照
      
    }


    print $str;
    ?>
  </body>
</html>