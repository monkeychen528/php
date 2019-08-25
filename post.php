<?php
    

$a = isset($_POST['a']) ? intval($_POST['a']) : 0;
$b = isset($_POST['b']) ? (int) $_POST['b'] : 0;

echo $a + $b;

    // $a= isset($_POST['a'])? intval($_POST['a']):0;//isset()是否有設定過,intval()強制轉為數字
    // $b=isset($_POST['b'])? intval($_POST['b']):0;//網址列如果變數b是字串則為0
    // //post跟get會依據表單的action設定決定
    // echo $_POST['a']+$_POST['b'];
    // echo "\n";
    // echo $a+$b;
