<?php

require __DIR__ . '/__connect_db.php';


if(! empty($_POST['day']) or ! empty($_POST['type'])){
    $sql = sprintf("SELECT a.*, s.`%s` FROM `allstore` a JOIN `store_information` s ON s.`sid` =a.`sid`
    WHERE a.`type` LIKE '%s' ORDER BY `sid` DESC LIMIT %s,%s", $_POST['day'], $_POST['type'],($page - 1) * $per_page, $per_page);

    header('Location: '. 'bar_search.php');
    };
if(! empty($_GET['day']) or ! empty($_GET['type'])){
    $sql = sprintf("SELECT a.*, s.`%s` FROM `allstore` a JOIN `store_information` s ON s.`sid` =a.`sid`
    WHERE a.`type` LIKE '%s' ORDER BY `sid` DESC LIMIT %s,%s", $_GET['day'], $_GET['type'],($page - 1) * $per_page, $per_page);
    
    header('Location: '. 'bar_search.php');
    }else {
    header('Location: bar_list.php');
    };

?>