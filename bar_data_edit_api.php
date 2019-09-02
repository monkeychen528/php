<?php
require __DIR__ . '/__connect_db.php';
//json除錯
$result = [
    'success' => false,
    'code' => 404,
    'info' => '輸入錯誤',
    'post' => $_POST,
];

//判斷必要欄位沒填  Todo:前面js可擋(未寫)
if (
    empty($_POST['store_name']) or
    empty($_POST['phone']) or
    empty($_POST['type']) or
    empty($_POST['address'])
) {
    $result['info'] = '必要欄位未填';
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

//設定路徑
$upload_dir = 'lib/images/bar/uploads/';
//允許圖片格式
$allowed_type = [
    'image/jpg',
    'image/png',
];

//設定編碼檔案後的副檔名
$ext = [
    'image/png' => '.png',
    'image/jpeg' => '.jpg',
];

//判斷圖片是否有更改

if (!empty($_FILES['preview-pic']['name'])) {
    if (in_array($_FILES['preview-pic']['type'], $allowed_type)) {
        $new_filename = sha1(uniqid() . $_FILES['preview-pic']['name']);
        $new_ext = $ext[$_FILES['preview-pic']['type']];
        move_uploaded_file($_FILES['preview-pic']['tmp_name'], $upload_dir . $new_filename . $new_ext);


        //判斷type有沒有勾選
        if (!empty($_POST['type'])) {
            // $str = implode(' ', $_POST['type']);
            $type_str = json_encode($_POST['type'], JSON_UNESCAPED_UNICODE);
            $sql = "UPDATE `allstore` SET `type`=?
                WHERE `sid`=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $type_str,
                $_POST['sid'],
            ]);
        } else {
            $type_str = '[]';
        }
        // 判斷有沒有勾選service
        if (!empty($_POST['service'])) {
            // $str = implode(' ', $_POST['service']);
            $service_str = json_encode($_POST['service'], JSON_UNESCAPED_UNICODE);
            $sql = "UPDATE `allstore` SET `service`=?
                WHERE `sid`=?";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $service_str,
                $_POST['sid'],
            ]);
        } else {
            $service_str = '[]';
        }
        //圖片&資料寫入資料庫
        $sql = "UPDATE `allstore` SET 
            `store-name`=?, `preview-pic`=?,
            `phone`=?,
            `address`=?,`company-id`=?,
            `owner`=?,`email`=?,`how-much`=?
            WHERE `sid`=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['store_name'],
            $new_filename . $new_ext,
            $_POST['phone'],
            $_POST['address'],
            $_POST['company-id'],
            $_POST['owner'],
            $_POST['email'],
            $_POST['how-much'],
            $_POST['sid'],
        ]);

        $day_sql = "UPDATE `store_information` SET
            `Monday`=?, `Tuesday`=?, `Wednesday`=?, `Thursday`=?, 
            `Friday`=?, `Saturday`=?, `Sunday`=?  WHERE `sid`=?";
        $d_stmt = $pdo->prepare($day_sql);
        $d_stmt->execute([
            $_POST['sid'],
            $_POST['Mon'],
            $_POST['Tue'],
            $_POST['Wed'],
            $_POST['Tur'],
            $_POST['Fri'],
            $_POST['Sat'],
            $_POST['Sun'],
        ]);

        if ($stmt->rowCount() == 1) {
            $result['code'] = 210;
            $result['success'] = true;
            $result['info'] = '成功修改';
        } else {
            $result['info'] = "照片資料欄位不足";
            $result['code'] = 480;
        }
    }
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

// 判斷有沒有勾選type
if (!empty($_POST['type'])) {
    $str = implode(' ', $_POST['type']);
    $type_str = json_encode($_POST['type'], JSON_UNESCAPED_UNICODE);
    $sql = "UPDATE `allstore` SET `type`=?
            WHERE `sid`=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $type_str,
        $_POST['sid'],
    ]);
} else {
    $type_str = '[]';
}
// 判斷有沒有勾選service
if (!empty($_POST['service'])) {
    $str = implode(' ', $_POST['service']);
    $service_str = json_encode($_POST['service'], JSON_UNESCAPED_UNICODE);
    $sql = "UPDATE `allstore` SET `service`=?
            WHERE `sid`=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $service_str,
        $_POST['sid'],
    ]);
} else {
    $service_str = '[]';
}

// 一定要執行的
$sql = "UPDATE `allstore` SET `store-name`=?,
        `phone`=?,`address`=?,
        `company-id`=?,
        `owner`=?,`email`=?,
        `how-much`=?
        WHERE `sid`=?";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $_POST['store_name'],
    $_POST['phone'],
    $_POST['address'],
    $_POST['company-id'],
    $_POST['owner'],
    $_POST['email'],
    $_POST['how-much'],
    $_POST['sid'],
]);

$result['post']=$_POST['Mon'];
    if(! empty($_POST['Mon']or$_POST['Tue'])){
        $day_sql = "UPDATE `store_information` SET
            `Monday`=?, `Tuesday`=?, `Wednesday`=?, `Thursday`=?, 
            `Friday`=?, `Saturday`=?, `Sunday`=?  WHERE `sid`=?";
    $d_stmt = $pdo->prepare($day_sql);
    $d_stmt->execute([
        $_POST['Mon'],
        $_POST['Tue'],
        $_POST['Wed'],
        $_POST['Tur'],
        $_POST['Fri'],
        $_POST['Sat'],
        $_POST['Sun'],
        $_POST['sid'],

    ]);
    };
if ($stmt and $d_stmt->rowCount() == 1) {
    $result['success'] = true;
    $result['code'] = 210;
    $result['info'] = '成功修改';
} else {
    $result['info'] = '失敗';
}
//給後端看的json，沒上傳圖片但有更改內容
// if($stmt->rowCount()==1){
//     $result['code']=250;
//     $result['success']=true;
//     $result['info']='成功修改';
// }else{
//     $result['info']="資料欄位不足";
//     $result['code']=440;
// }
echo json_encode($result, JSON_UNESCAPED_UNICODE);
