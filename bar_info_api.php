<?php

    require 'connect_db.php';

//json除錯
$result=[
    'success'=>false,
    'code'=>404,
    'info'=>'輸入錯誤',
    'post'=>$_POST
];



if(empty($_GET['store_name'] and
            $_GET['phone'] and
            $_GET['opened-time'] and
            $_GET['type'] and
            $_GET['address']
            )){         
       exit;
}

if(! empty($_POST['type'])){
        $str=implode(' ',$_POST['type']);
        echo $str;
        
        $type_str=json_encode($str,JSON_UNESCAPED_UNICODE);
        echo($type_str);
    };

if(! empty($_POST['service'])){
        $str=implode(' ',$_POST['service']);
        echo $str;
        $service_str=json_encode($str,JSON_UNESCAPED_UNICODE);
        echo($service_str);
    };







    $sql="INSERT INTO `allstore`(
        `store-name`, `phone`, `opened-time`, `type`, `address`, 
        `preview-pic`, `company-id`, `owner`, `email`, 
        `how-much`, `service`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    
    $stmt=$pdo->prepare($sql);

    $stmt->execute([
        $_POST['store_name'],
        $_POST['phone'],
        $_POST['opened-time'],
        $type_str,
        $_POST['address'],
        $_POST['preview-pic'],
        $_POST['company-id'],
        $_POST['owner'],
        $_POST['email'], 
        $_POST['how-much'], 
        $service_str

    
    ]);



if($stmt->rowCount()==1){
    $result['success']=true;
    $result['code']=200;
    $result['info']='成功新增';
}

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
