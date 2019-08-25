<?php
include 'connect_db.php';
?>

<style>
    .form-check{
        margin: 10px 0;
    }

</style>

<!-- 內容 -->

<?php include 'html_header.php';?>

<div class="container">

    <form name="form1" action="bar_form_api.php" method="post">
        <h2>酒bar資料填寫</h2>
    <div class="form-group">
        <label for="store_name">酒bar名稱</label>
        <input name="store_name" type="text" class="form-control" id="store_name">
        <small id="emailHelp" class="form-text ">"需要檢驗用"</small>
    </div>

    <div class="form-group">
        <label for="num">電話</label>
        <input name="phone" type="number" class="form-control" id="num">
        <small id="numHelp" class="form-text">"需要檢驗用"</small>
    </div>
    <div class="form-group">
        <label for="address">地址</label>
        <input name="address" type="text" class="form-control" id="address">
        <!-- 店名連接api 變成經緯寫法 -->
        <small id="addressHelp" class="form-text">"需要檢驗用"</small>
    </div>
    <h2>餐廳類型</h2>
        <div class="form-check form-check-inline">
            <input name="type[]" type="checkbox" id="inlineCheckbox1" value="日式">
            <label class="form-check-label" for="inlineCheckbox1">日式</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="type[]" type="checkbox" id="inlineCheckbox2" value="西式">
            <label class="form-check-label" for="inlineCheckbox2">西式</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="type[]" type="checkbox" id="inlineCheckbox3" value="專門調酒">
            <label class="form-check-label" for="inlineCheckbox3">專門調酒</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="type[]" type="checkbox" id="inlineCheckbox3" value="launch bar">
            <label class="form-check-label" for="inlineCheckbox4">launch bar</label>
        </div>
    <div class="form-group">
        <label for="preview-pic">預覽圖(暫留位子)</label>
        <input name="preview-pic" type="file" class="form-control" id="preview-pic" >
        <small id="emailHelp" class="form-text text-muted">"需要檢驗用"</small>
    </div>

    <div class="form-group">
        <label for="time">營業時間</label>
        <input name="opened-time" type="text" class="form-control" id="time">
        <small id="timeHelp" class="form-text text-muted">"需要檢驗用"</small>
    </div>
    <div>--選填--</div>

    <div class="form-group">
        <label for="owner">營業人</label>
        <input name="owner" type="text" class="form-control" id="owner">
        <!-- 確認無效字元 -->
    </div>
    <div class="form-group">
        <label for="email">email</label>
        <input name="email" type="text" class="form-control" id="email">
        <small id="emailHelp" class="form-text text-muted">"需要檢驗用"</small>
    </div>
    <div class="form-group">
        <label for="num">統編</label>
        <input name="company-id" type="number" class="form-control" id="num">
        <small id="numHelp" class="form-text">"需要檢驗用"</small>
    </div>
    <div class="form-group">
        <label for="money">參考價位</label>
        <input name="how-much" type="number" class="form-control" id="money">
    </div>
    <h2>服務項目</h2>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox1" value="停車位">
            <label class="form-check-label" for="inlineCheckbox1">停車位</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox2" value="夜間叫車">
            <label class="form-check-label" for="inlineCheckbox2">夜間叫車</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox3" value="無障礙廁所">
            <label class="form-check-label" for="inlineCheckbox3">無障礙廁所</label>
        </div>
        <div class="form-check form-check-inline">
            <input name="service[]" type="checkbox" id="inlineCheckbox3" value="DJ">
            <label class="form-check-label" for="inlineCheckbox4">DJ</label>
        </div>
        <div>
            <input type="checkbox" id="inlineCheckbox3">
            <label class="form-check-label" for="inlineCheckbox3">我同意平台相關隱私政策</label>
        </div>
    
        
        <button type="submit" class="btn btn-primary" onsubmit="return checkForm()">Submit</button>
    </form>
    </div>


    <script>
        let btn =document.querySelector('#submit_btn');
        
        function checkForm(){
            fetch('bar_form_api.php')
                .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                });
                return false;
        }
       
    </script>
<?php   
include 'html_foot.php';
?>