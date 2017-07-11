<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title></title>
</head>
<body>
<?php
for ($i = 1; $i <=100; $i++) {
    if($i % 15 === 0){
   print 'FizzBuzz'. "\n"; 
   } else if ($i % 3 === 0){
    print 'Fizz' . "\n";  
   } else if ($i % 5 === 0){
    print 'Buzz';     
    }else{
    print   "\n". $i ."\n";
    }  
   print '<br>'; 
        
}

?>
</body>
</html>