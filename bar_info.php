<?php
//酒bar自己的介紹
require 'connect_db.php';



$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;


$sql = "SELECT `sid`,`store-name`, `phone`, 
    `opened-time`, `type`, `address`, 
    `preview-pic`, `company-id`, 
    `owner`, `email`, `how-much`, `service` FROM `allstore` 
    WHERE `sid`=10";


$stmt = $pdo->query($sql)->fetch();


foreach($stmt as $k=>$v);
echo $stmt['service'];
?>
<?php require 'html_header.php'?> 
 
    <form name="form1" action="bar_info_api.php" method="post"  onsubmit="return checkForm()">
        <h2>修改資料</h2>
        <div class="form-group">
            <label for="store_name">酒bar名稱</label>
            <input name="store_name" type="text" class="form-control" id="store_name"
            value="<?=$stmt['store-name']?>">
            <small id="emailHelp" class="form-text ">"需要檢驗用"</small>
        </div>

        <div class="form-group">
            <label for="num">電話</label>
            <input name="phone" type="number" class="form-control" id="num"
            value="<?=$stmt['phone']?>">
            <small id="numHelp" class="form-text">"需要檢驗用"</small>
        </div>
        <div class="form-group">
            <label for="address">地址</label>
            <input name="address" type="text" class="form-control" id="address"
            value="<?=$stmt['address']?>">
            <!-- 店名連接api 變成經緯寫法 -->
            <small id="addressHelp" class="form-text">"需要檢驗用"</small>
        </div>
        <h2>餐廳類型</h2>
            <div class="form-check form-check-inline">
                <input name="type[]" type="checkbox" id="inlineCheckbox1" value="日式" 
                <?=strrpos($stmt['type'],"日式")>0? 'checked':'' ?>>
                <label class="form-check-label" for="inlineCheckbox1">日式</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="type[]" type="checkbox" id="inlineCheckbox2" value="西式"
                <?=strrpos($stmt['type'],"西式")>0? 'checked':'' ?>>
                <label class="form-check-label" for="inlineCheckbox2">西式</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="type[]" type="checkbox" id="inlineCheckbox3" value="專門調酒"
                <?=strrpos($stmt['type'],"專門調酒")>0? 'checked':'' ?>>
                <label class="form-check-label" for="inlineCheckbox3">專門調酒</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="type[]" type="checkbox" id="inlineCheckbox3" value="launch bar"
                <?=strrpos($stmt['type'],"launch bar")>0? 'checked':'' ?>>
                <label class="form-check-label" for="inlineCheckbox4">launch bar</label>
            </div>
        <div class="form-group">
            <label for="preview-pic">預覽圖(暫留位子)</label>
            <input name="preview-pic" type="file" class="form-control" id="preview-pic" >
            <small id="emailHelp" class="form-text text-muted">"需要檢驗用"</small>
        </div>

        <div class="form-group">
            <label for="time">營業時間</label>
            <input name="opened-time" type="text" class="form-control" id="time"
            value="<?=$stmt['opened-time']?>">
            <small id="timeHelp" class="form-text text-muted">"需要檢驗用"</small>
        </div>
        <div>--選填--</div>

        <div class="form-group">
            <label for="owner">營業人</label>
            <input name="owner" type="text" class="form-control" id="owner"
            value="<?=$stmt['owner']?>">
            <!-- 確認無效字元 -->
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input name="email" type="text" class="form-control" id="email"
            value="<?=$stmt['email']?>">
            <small id="emailHelp" class="form-text text-muted">"需要檢驗用"</small>
        </div>
        <div class="form-group">
            <label for="num">統編</label>
            <input name="company-id" type="number" class="form-control" id="num"
            value="<?=$stmt['company-id']?>">
            <small id="numHelp" class="form-text">"需要檢驗用"</small>
        </div>
        <div class="form-group">
            <label for="money">參考價位</label>
            <input name="how-much" type="number" class="form-control" id="money"
            value="<?=$stmt['number']?>">
        </div>
        <h2>服務項目</h2>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox1" value="停車位"
            <?=strrpos($stmt['service'],"停車位")>0? 'checked':'' ?>>
            <label class="form-check-label" for="inlineCheckbox1">停車位</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox2" value="夜間叫車"
            <?=strrpos($stmt['service'],"夜間叫車")>0? 'checked':'' ?>>
            <label class="form-check-label" for="inlineCheckbox2">夜間叫車</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox3" value="無障礙廁所"
            <?=strrpos($stmt['service'],"無障礙廁所")>0? 'checked':'' ?>>
            <label class="form-check-label" for="inlineCheckbox3">無障礙廁所</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox3" value="DJ"
            <?=strrpos($stmt['service'],"DJ")>0? 'checked':'' ?>>
            <label class="form-check-label" for="inlineCheckbox4">DJ</label>
        </div>
        <div>
            <input type="checkbox" id="inlineCheckbox3">
            <label class="form-check-label" for="inlineCheckbox3">我同意平台相關隱私政策</label>
        </div>
    
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        解決不跳轉問題
        // function checkForm(){
        //     fetch('bar_info_api.php')
        //     .then(response=>{
        //         return response.json();
        //     })
        //     .then(json=>{
        //             console.log(json);
        //         });
        //     return false;
        // }
    
    
    </script>


<?php require 'html_foot.php' ?>
