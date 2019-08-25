<?php
require '__connect_db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="uploag_test.php" method="POST">

        <input type="text" name="name" id="name">檔案名稱<br>
        <?php<input type="text" name="path"value="">
 ?>
        <input type="file" name="address" id="img">
   
        <!-- js顯示預覽圖片 -->
        <?//= isset($_POST['$address'])?$_POST['__FILE__']:''?>
        <input type="submit" name="submit" value="上傳檔案">
    </form>
</body>
</html>