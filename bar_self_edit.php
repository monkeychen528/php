<?php
// require __DIR__.'/__admin_required.php';
require __DIR__ . '/__connect_db.php';

if (!isset($_SESSION)) {
    session_start();
}

$sql = "SELECT `sid`, `store-name`, `phone`, `type`, `address`, `preview-pic`,
`company-id`, `owner`, `email`, `how-much`, `service` FROM `allstore` WHERE `sid`='1'";

$stmt = $pdo->query($sql)->fetch();

?>

<style>
    .box {
        width: 100%;
        height: 1000px;
        background: #333;
    }

    .content {
        margin-bottom: 60px;
    }

    /* card css */
    .card-wrap {
        position: relative;
    }

    .card {
        width: 300px;
        height: 600px;
        margin: 60 0 60 30px;
        box-shadow: 2px 1px 1px #ccc;
        padding: 6px;
        text-align: center;
        transition: .5s;
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
    }

    .card h5 {
        margin-top: 6px;
    }

    .custom-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto;
    }

    .custom-pic img {
        width: 100%;
        height: 100%;
        margin: 0 auto;
    }

    /* form css */
    .form {
        width: 40%;
        margin: 60 0 20 50px;
    }

    .type input+label {
        margin: 4px;
    }

    .slide-wrap {
        width: 259px;
        height: 200px;
        margin: 20px auto;
        /* background: #ccc; */
        position: relative;
        overflow: hidden;
    }

    .pic_arrow {
        width: 20px;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        top: 0;
        bottom: 0;
    }

    .pic_arrow:hover {
        background: rgba(0, 0, 0, .6);
    }

    .slider_container {
        position: relative;
        transition: .5s
    }

    #slider_container li img {
        height: 100%;
        width: 100%;
        object-fit: cover;

    }

    #slider_container li {
        height: 259px;
        flex: 1 0 0;
    }

    #next_pic {
        right: 0px;
    }

    #prev_pic {
        left: 0px;
    }
    .card-front{
        transition: .5s;
    }
    .card-back{
        position: absolute;
        top: 20px;
        left: 50%;
        margin: 0 -32px;
    }
    .rotate{
        transform-style: preserve-3d;
        transform: rotateY(180deg);
    }
    .backface{
        backface-visibility: hidden;
    }

</style>

<?php include __DIR__ . '/__html_head.php'?>
<?php include __DIR__ . '/__navbar.php'?>


<div class="container-fluid ">
    <div class="d-flex justify-content-center content">
        <div class="card-wrap">
            <div class="card d-flex">
                <div class="card-front">
                    <div class="custom-pic"><img
                            src="lib/images/bar/uploads/215eb20ba6911ae93966ffb40c8ba946c7ea0811.jpg" alt=""></div>
                    <h5>酒bar名字</h5>
                    <h5>電話</h5>
                    <h5>地址</h5>
                    <h5>email</h5>
                    <h5>預覽圖片</h5>
                    <div class="slide-wrap">
                        <ul class="list-unstyled slider_container d-flex" id="slider_container">
                            <li><img src="pic1.jpg" alt=""></li>
                            <li><img src="pic2.jpg" alt=""></li>
                            <li><img src="pic3.jpg" alt=""></li>
                            <li><img src="pic4.jpg" alt=""></li>
                        </ul>
                        <div class="pic_arrow" id="prev_pic">
                            <i class="fas fa-chevron-left"></i>
                        </div>
                        <ul class="list-unstyled list_container d-flex m-0 " id="list_dot">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class="pic_arrow" id="next_pic">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
                <div class="card-back d-none">
                    <h5>營業人</h5>
                    <h5>統編</h5>
                    <span>類型</span>
                    <ul class="list-unstyled">
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <span>特別服務</span>
                    <!-- 特殊服務要用動態生成的方式 -->
                    <ul class="list-unstyled">
                        <li></li>
                        <li></li>
                    </ul>    
                </div>
            </div>

        </div>
        <form name="form1" action="" class="form">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="store_name">酒bar名稱</label>
                        <input name="store_name" type="text" class="form-control" id="store_name">
                        <small id="store_nameHelp" class="form-text "></small>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="phone">電話</label>
                        <input name="phone" type="number" class="form-control" id="phone">
                        <small id="phoneHelp" class="form-text"></small>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="address">地址</label>
                <input name="address" type="text" class="form-control" id="address">
                <!-- 店名連接api 變成經緯寫法 -->
                <small id="addressHelp" class="form-text"></small>
            </div>
            <div class="form-group">
                <label for="email">email</label>
                <input name="email" type="text" class="form-control" id="email">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
                <label for="preview-pic">預覽圖(暫留位子)</label><br>
                <input name="preview-pic" type="file" id="preview-pic" onchange="previewFile()">
                <div style="width:60%">
                    <img src="" alt="" class="show_pic img-fluid">
                </div>
            </div>
            <!--營業時間  -->
            <h5>營業時間</h5>
            <label class='checkbox-inline checkboxeach'>
                <input id='checkAll' type='checkbox' onclick="fillAll">套用此欄至所有欄位
            </label>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="time">星期一</label>
                    <input name="Mon" type="text" class="form-control" id="arg_val">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期二</label>
                    <input name="Tue" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期三</label>
                    <input name="Wed" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期四</label>
                    <input name="Tur" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期五</label>
                    <input name="Fri" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期六</label>
                    <input name="Sat" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group col-md-6">
                    <label for="time">星期天</label>
                    <input name="Sun" type="text" class="form-control time">
                    <small id="timeHelp" class="form-text text-muted"></small>
                </div>
            </div>
            <h5>餐廳類型</h5>
            <div class="form-check form-check-inline type">
                <input name="type[]" type="checkbox" id="inlineCheckbox1" value="日式">
                <label class="form-check-label" for="inlineCheckbox1">日式</label>

                <input name="type[]" type="checkbox" id="inlineCheckbox2" value="西式">
                <label class="form-check-label" for="inlineCheckbox2">西式</label>

                <input name="type[]" type="checkbox" id="inlineCheckbox3" value="專門調酒">
                <label class="form-check-label" for="inlineCheckbox3">專門調酒</label>

                <input name="type[]" type="checkbox" id="inlineCheckbox4" value="lounge bar">
                <label class="form-check-label" for="inlineCheckbox4">lounge bar</label>
                <small id="addressHelp" class="form-text"></small>
            </div>

            <div>--選填--</div>
            <div class="form-group">
                <label for="owner">營業人</label>
                <input name="owner" type="text" class="form-control" id="owner">
                <!-- 確認無效字元 -->
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
            <h5>服務項目</h5>
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
            <div class="row">
                <div class="col-6">
                    <button class="btn btn-primary">更改</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // slider設定
        var listwidth = 280,//wrapper的寬度設置是800px
            listNum = 0;
        var slideCount = $('#slider_container li').length;
        $('#slider_container').css('width', slideCount * listwidth);
        //為了要動態改變幻燈片的寬度，找出slider_container li的數量一樣用length(抓li而不是ul)
        //前一張圖的ui
        $('#prev_pic').click(function () {
            listNum--;
            if (listNum < 0) listNum = slideCount - 1; //此時slideCount等於抓li的數量(減1就等於listNum的位置)
            sliderun();
        })
        //後一張圖的ui
        $('#next_pic').click(function () {
            listNum++;
            if (listNum > (slideCount - 1)) listNum = 0; //確認listNum永遠小於4
            sliderun();
        })
        setInterval(function () {
            listNum++;
            if (listNum > (slideCount - 1)) listNum = 0; //確認listNum永遠小於4
            sliderun();
        }, 2000)
        function sliderun() {
            $('#slider_container').css('left', 0 - (listNum * listwidth))
        }

        //捲動滾軸 card翻面

        $(window).scroll(function () {
            let scrollTop = $(this).scrollTop()
            $('.card').css('top', scrollTop)
            if (scrollTop > 150) {
                $('.card').addClass('rotate');
                $('.card-front').addClass('rotate backface');
                // $('.card-front').css('transform','translateX'+'-300px')
                // $('.card-front').css('transform','rotateY'+'(180deg)');
                $('.card-back').addClass('rotate d-block');
                // $('.card-back').css('transform','rotateY'+'(180deg)');

            } else {
                $('.card').removeClass('rotate');
                $('.card-front').removeClass('rotate backface');
                // $('.card').css('transform','rotateY'+'(180deg)');
                $('.card-back').removeClass('rotate d-block');
                // $('.card-back').css('transform','rotateY'+'(180deg)');

            }

            // console.log(scrollTop);
        })
        // $('.card').s


    </script>


    <?php include __DIR__ . '/__html_foot.php'?>