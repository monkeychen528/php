
<?php
// echo $_POST['__FILE__'];
require '__connect_db.php';
if(empty($_POST['name'])){
        exit;
    }


$p_sql="INSERT INTO `test`(`name`,`address`) VALUES (?,?)";

$stmt=$pdo->prepare($p_sql);

$stmt->execute([
    $_POST['name'],
    $_POST['address']

]);
echo $stmt->rowCount();

?>