<?php
require 'connect_db.php';

if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['file']['name'];
    echo $image;
    // Get text
    $path =$_FILES["file"]["tmp_name"];
    echo $path;

    move_uploaded_file($_FILES["file"]["tmp_name"],"upload/".
    $_FILES["file"]["name"]);
}
    $sql = "INSERT INTO `test` (
        `name`, `mobile`) VALUES (?, ?)";
    // execute query
    
    $stmt=$pdo->query($sql);


    $stmt->execute([
                $_POST['name'],
                $_POST['mobile'],
        ]);

echo $stmt->rowCount();