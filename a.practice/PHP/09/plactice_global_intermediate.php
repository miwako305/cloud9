<?php 
//変動初期化
$result="";
$cp_choice="";
$user_choice="";
?>
<?php
if($_SERVER['REQUEST_METHOD'] ==='POST'){
    if(isset($_POST['user_choice'])===TRUE){
    $user_choice = $_POST['user_choice'];    
}if ($user_choice===""){
    $user_choice="未選択";
}
}
?>


<?php 
  $rand = mt_rand(0, 2);

  if ($rand === 0) {
    $cp_choice = 'グー';
  } else if ($rand === 1) {
    $cp_choice = 'チョキ';
  } else if ($rand === 2) {
    $cp_choice = 'パー';
  }
 ?> 
<?php

if($user_choice === 'パー'){
    if($rand === 0){
        $result = '勝ち';
    }if($rand === 1){
        $result ='負け';
    }if($rand === 2 ){
        $result ='引き分け';
    }}
    
   if($user_choice === 'グー'){
    if($rand === 0){
        $result = '勝ち';
    }if($rand === 1){
        $result ==='負け';
    }if($rand === 2 ){
        $result ='引き分け';
    }}
    
    
    if($user_choice === 'チョキ'){
    if($rand === 0){
        $result = '勝ち';
    }if($rand === 1){
        $result ='負け';
    }if($rand === 2 ){
        $result ='引き分け';
    }}
?>
        

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
<title></title>
</head>
<body> 
        <h1>じゃんけん勝負</h1>
        <section>
            <p>自分: <?php print $user_choice; ?></p>
            <p>相手: <?php print$cp_choice; ?></p>
            <p>結果: <?php print $result; ?></p>
        </section>
<form method = "post">
    <p>
                <input type="radio" name="user_choice" value="グー" <?php if ($user_choice === 'グー') { print 'checked'; } ?>>グー
                <input type="radio" name="user_choice" value="チョキ" <?php if ($user_choice === 'チョキ') { print 'checked'; } ?>>チョキ
                <input type="radio" name="user_choice" value="パー" <?php if ($user_choice === 'パー') { print 'checked'; } ?>>パー
    </p>
    <input type="submit" name="勝負"/>
</form>
</body>
</html>