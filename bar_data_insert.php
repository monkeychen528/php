<?php
// require __DIR__ . '/__admin_required.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'page_name';
$page_title = '新增資料';
?>

<style>
    .form-check{
        margin: 10px 0;
    }
</style>

<!-- 內容 -->
<?php include __DIR__ . '/__html_head.php'?>
<?php include __DIR__ . '/__navbar.php'?>

<!--content -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 pt-3" style="margin-top: 3rem;">

    <div class="row">
        <div class="col">
            <!--新增成功或失敗的提示訊息-->
            <div class="alert alert-primary" role="alert" id="info_bar" style="display: none"></div>
        </div>
    </div>

    <div class="container">
        <form name="form1" onsubmit="return checkForm()" enctype="multipart/form-data">
            <h2>酒bar資料填寫</h2>
            <div class="form-group">
                <label for="store_name">酒bar名稱</label>
                <input name="store_name" type="text" class="form-control" id="store_name">
                <small id="store_nameHelp" class="form-text ">"需要檢驗用"</small>
            </div>

            <div class="form-group">
                <label for="phone">電話</label>
                <input name="phone" type="number" class="form-control" id="phone">
                <small id="phoneHelp" class="form-text">"需要檢驗用"</small>
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
                    <input name="type[]" type="checkbox" id="inlineCheckbox4" value="launch bar">
                    <label class="form-check-label" for="inlineCheckbox4">launch bar</label>
                </div>
            <div class="form-group">
                <label for="preview-pic">預覽圖(暫留位子)</label><br>
                <input name="preview-pic" type="file" id="preview-pic"
                onchange="previewFile()">
                <img src="" alt="" class="show_pic">
            </div>
            <!--營業時間  -->
            <h3>營業時間</h3>
            <label class='checkbox-inline checkboxeach'>
                <input id='checkAll' type='checkbox' onclick="fillAll">套用此欄至所有欄位
            </label>
            <div class="form-group">
                <label for="time">星期一</label>
                <input name="Mon" type="text" class="form-control" id="arg_val">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期二</label>
                <input name="Tue" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期三</label>
                <input name="Wed" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期四</label>
                <input name="Tur" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期五</label>
                <input name="Fri" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期六</label>
                <input name="Sat" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="time">星期天</label>
                <input name="Sun" type="text" class="form-control time">
                <small id="timeHelp" class="form-text text-muted"></small>
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
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="company-id">統編</label>
                <input name="company-id" type="number" class="form-control" id="company-id">
                <small id="company-idHelp" class="form-text"></small>
            </div>
            <div class="form-group">
                <label for="money">參考價位</label>
                <input name="how-much" type="number" class="form-control" id="money">
            </div>
            <h2>服務項目</h2>
            <div class="form-check form-check-inline">
                <input name="service[]" type="checkbox" id="inlineCheckbox5" value="停車位">
                <label class="form-check-label" for="inlineCheckbox5">停車位</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="service[]" type="checkbox" id="inlineCheckbox6" value="夜間叫車">
                <label class="form-check-label" for="inlineCheckbox6">夜間叫車</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="service[]" type="checkbox" id="inlineCheckbox7" value="無障礙廁所">
                <label class="form-check-label" for="inlineCheckbox7">無障礙廁所</label>
            </div>
            <div class="form-check form-check-inline">
                <input name="service[]" type="checkbox" id="inlineCheckbox8" value="DJ">
                <label class="form-check-label" for="inlineCheckbox8">DJ</label>
            </div>
            <div>
                <input type="checkbox" id="inlineCheckbox9" value="">
                <label class="form-check-label" for="inlineCheckbox9">我同意平台相關隱私政策</label>
            </div>
            <button type="submit" class="btn btn-custom" id="submit_btn">Submit</button>
        </form>
    </div>

        </div>
    </div>
</div>

    <script>
        let info_bar = document.querySelector('#info_bar');
        let btn =document.querySelector('#submit_btn');
        let i, s, item;

        // -------批次填入
        let checkAll = document.querySelector('#checkAll');
        let times = document.getElementsByClassName('time');
        let auto_fill = document.getElementById('arg_val');
        let cancel = true;

        function fillAll() {
            if (cancel) {
                for (i = 0; i < times.length; i++) {
                    let time = times[i];
                    if (time.value == "") {
                        time.value = auto_fill.value;
                    }
                }
            } else {
                for (i = 0; i < times.length; i++) {
                    let time = times[i];
                    time.value = "";
                }
            }
            cancel = !cancel;
        }
        checkAll.addEventListener('click', fillAll);

        //----------圖片預覽
        function upload(){
            document.querySelector('#preview-pic').click();
        }
        function previewFile() {
            var preview = document.querySelector('.show_pic');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);
            if (file) {
               
                reader.readAsDataURL(file);
            }
        }

            //正確格式定義
        const required_fields = [
            {
                id: 'store_name',
                pattern: /^\S{2,}/,
                info: '請填寫正確的姓名',
            },
            {
                id: 'email',
                pattern: /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i,
                info: '請填寫正確的 email 格式',
            },
            {
                id: 'phone',
                pattern: /^\(?\d{2}\)?[\s\-]?\d{4}\-?\d{4}|\d{3}$/,
                info: '請填寫正確的市話號碼',
            },
        ];

        // // 拿到對應的 input element (el), 顯示訊息的 small element (infoEl)
        for (s in required_fields) {
            item = required_fields[s];
            item.el = document.querySelector('#' + item.id);
            item.infoEl = document.querySelector('#' + item.id + 'Help');
            // console.log(item.el);
        }

        //----------ajax
        function checkForm(){

            // 先讓所有欄位外觀回復到原本的狀態
            for (s in required_fields) {
                item = required_fields[s];
                item.el.style.border = '1px solid #CCCCCC';
                item.infoEl.innerHTML = ' ';
            }
            info_bar.style.display = 'none';
        

            submit_btn.style.display = 'none';

            // 檢查必填欄位, 欄位值的格式
            
            let isPass = true;
            for (s in required_fields) {
                item = required_fields[s];
                if (! item.pattern.test(item.el.value)) {
                    item.el.style.border = '2px solid red';
                    item.infoEl.innerHTML = item.info;
                    isPass = false;
                }
            }

            let fd = new FormData(document.form1);

            if (isPass) {
            fetch('bar_data_insert_api.php',{
                method: 'POST',
                body: fd,
            })
                .then(response=>{
                    return response.json();
                })
                .then(json=>{
                    console.log(json);
                    submit_btn.style.display = 'none'; //防止訊號不好重複按鍵新增
                    info_bar.style.display = 'block'; //顯示提示訊息
                    info_bar.innerHTML = json.info; //將json資訊加入到訊息bar裡
                    if (json.success) {
                            info_bar.className = 'alert alert-success';
                            setTimeout(function(){
                                location.href = 'bar_list.php';
                            }, 1000); //登錄成功 1秒回首頁
                        } else {
                            info_bar.className = 'alert alert-danger';
                        }
                });
            }else {
                submit_btn.style.display = 'block';

            }return false;
        }

    </script>

<?php include __DIR__. '/__html_foot.php' ?>