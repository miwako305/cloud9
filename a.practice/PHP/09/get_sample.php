<?php
if (isset($_GET['query']) === TRUE){
    $query = htmlspecialchars($_GET['query'], ENT_QUOTES,'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>スーパーグローバル変数</title>
<h1> 検索しよう</h1>
<?php 
//formからの検索文字列が渡っている場合はGoogle へのリンクを表示

if (isset ($query) === TRUE) { ?>
<a href = "https://www.google.co.jp/search? q=<?Php print $query; ?>" target = "_blank ">「<?php print $query ; ?>」をGoogleで検索する</a><br>
<a href = "https://www.bing.com/search? q=<?php print $query; ?>" target ="_blank">｢<?php print $query ;?> ｣をBingで検索する</a><br>
<a href = "https://www.search.yahoo.co.jp/search? q=<?php print $query;?>" target = "_blank ">「<?php print $query ; ?>」をYahooで検索する</a><br>
<P>このページをブックマークしてみよう</P>
<?PHP
} 
?>
<!--検索文字列送信用フォーム-->
<form method ="get"> 
   <input type ="text" name="query" value = "<?php if(isset($query)){print $query; } ?>">
   <input type ="submit" value="送信">
 </form>
</head>
<script>
</script>
<body>
</body>
</html>