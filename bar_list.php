<?php

require __DIR__ . '/__connect_db.php';

if (!isset($_SESSION)) {
    session_start();
}

$page_name = 'bar_list';
$page_title = '資料列表';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$per_page = 10; //每頁呈現筆數

$t_sql = "SELECT COUNT(1)FROM `allstore`"; //原本select後面接星號現在改為count(形式參數)，count會去找出資料總比數用()參數代替

$t_stm = $pdo->query($t_sql);
$totalRows = $t_stm->fetch(PDO::FETCH_NUM)[0]; //抓到每一欄以"1"的參數(陣列里1=>"所有欄位")
//其索引值給[0]就可拿出筆數

$totalPages = ceil($totalRows / $per_page); //(ceil無條件進位)

if ($page < 1) {
    header('Location: bar_list.php'); //如果頁面給的值小於1，重新載入頁面
    exit; //結束程式不抓下面資料
}
if ($page > $totalPages) {
    header('Location: bar_list.php?page=' . $totalPages);
    //如果頁面給的值大於總頁面，就給總頁面(最後一頁的值)
    exit;
}
//店面資訊資料表
$sql = sprintf("SELECT * FROM `allstore` ORDER BY `sid` DESC LIMIT %s,%s", ($page - 1) * $per_page, $per_page);
$stmt = $pdo->query($sql);
$rows = $stmt->fetchAll();

// exit;
// $stmt = $pdo->query("SELECT * FROM `custom` ORDER BY `sid` DESC");
?>


<style>
    .select {
        width: 80px;
        height: 30px;
        background-color: #eee;
        border: 1px solid gray;
    }

    .t_button {
        height: 80px;
        display: flex;
        flex-direction: column;
        background: white;
    }
</style>

<?php include __DIR__ . '/__html_head.php'?>
<?php include __DIR__ . '/__navbar.php'?>

<!--content -->
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 pt-3" style="margin-top: 3rem;">
            <nav aria-label="Page navigation example"style="margin-top: .5rem;">
                <ul class="pagination">
                    <li class="page-item d-flex">
                        <a class="page-link " href="?page=<?= $page - 15 ?>?>">
                            <i class="fas fa-angle-double-left"></i>
                        <a class="page-link " href="?page=<?=$page - 1?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                    <?php $p_start = $page - 5; //page呈現的頁面數+5&-5
                        $p_end = $page + 5;
                        for ($i = $p_start; $i <= $p_end; $i++):
                            if ($i<1 or $i>$totalPages) {
                                continue;
                        }
                    //continue是看if裡的條件，不是離開迴圈跟break意思不一樣
                    ?>

	                <?php //for ($i = 1; $i <= $totalPages; $i++):?>                                                                               
	                    <li class="page-item <?=$i == $page ? 'active' : ''?>">
                        <a class="page-link " href="?page=<?=$i?>"><?=$i?></a>
                        </li>
	            <!-- herf裡面插入php標籤，前面有設定page是以$_GET得到的引數，?page=直接切換到那個頁面的資料 -->
	                        
	                <?php endfor;?>
                    <li class="page-item d-flex">
                        <a class="page-link " href="?page=<?=$page + 1?>">
                        <i class="fas fa-chevron-right"></i></a>
                        <a class="page-link " href="?page=<?= $page + 15 ?>?>">
                        <i class="fas fa-angle-double-right"></i></a> 
                    </li>
                </ul>
            </nav>
            <div class="d-flex justify-content-between">
                <!-- 類別選單  -->
                <div>
                    <!-- <span style="font-size:16px;font-weight:500;color:#372614;">類別：</span> -->
                    <a href="bar_list.php"><button class="btn btn-custom mr-1" type="button" data-toggle="collapse">All</button></a>
                    <a href="bar_data_cate_jp.php"><button class="btn btn-custom mr-1" type="button" data-toggle="collapse">日式</button></a>
                    <a href="bar_data_cate_west.php"><button class="btn btn-custom" type="button" data-toggle="collapse">西式</button></a>
                </div>
                <!-- search bar -->

            <form name="form2" action="bar_search_api.php" method="POST">

                <select name="type" id="">
                    <option value="%日式%">日式</option>
                    <option value="%西式%">西式</option>
                    <option value="義式">義式</option>
                    <option value="lounge bar">lounge bar</option>
                    <option value="專門調酒">專門調酒</option>
                    <option value="居酒屋">居酒屋</option>
                    <option value="漢堡店">漢堡店</option>
                </select>
                <select name="day" id="">
                    <option value="Monday">星期一</option>
                    <option value="Tuesday">星期二</option>
                    <option value="Wednesday">星期三</option>
                    <option value="Thursday">星期四</option>
                    <option value="Friday">星期五</option>
                    <option value="Saturday">星期六</option>
                    <option value="Sunday">星期天</option>
                </select>
                <button type="submit" class="btn btn-primary">查詢</button>

            </form>

                <!-- 新增酒吧 -->
                <div><button class="btn btn-custom" onclick="window.location.href='bar_data_insert.php'" type="button">新增酒吧</button></div>
            </div>

            <!-- 表單內容 -->
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col" style="vertical-align:left;">
                            <label class='checkbox-inline checkboxeach'>
                                <input id='checkAll' type='checkbox' name='checkboxall'></label>
                        </th>

                        <th scope="col">#</th>
                        <th scope="col">店名</th>
                        <th scope="col">手機</th>
                        <th scope="col">類別</th>
                        <th scope="col">地址</th>
                        <th scope="col">店面圖片</th>
                        <th scope="col">營業人</th>
                        <th scope="col">統編</th>
                        <th scope="col">店面服務項目</th>

                        <th scope="col"><a href="javascript:delete_all()"><i class="fas fa-trash-alt"></i></th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td class="box_td">
                                <label class=' checkbox-inline checkboxeach'>
                                    <input type='checkbox' name="<?='check' . '[]'?>" value='<?=$r['sid']?>'> <!-- 選取框 -->
                                </label>
                            </td>

                            <td><?=htmlentities($r['sid'])?></td>
                            <td><?=htmlentities($r['store-name'])?></td>
                            <td><?=htmlentities($r['phone'])?></td>
                            <!-- 判斷今天星期時間 -->
                            <td><?=htmlentities(json_decode($r['type']))?></td>
                            <td><?=htmlentities($r['address'])?></td>
                            <td><img src="<?=htmlentities($r['preview-pic']) == true ? htmlentities($r['preview-pic']) : 'lib/images/bar/uploads/no_serve.jpg'?>" alt="" height="60"></td>
                            <td><?=htmlentities($r['owner'])?></td>
                            <td><?=htmlentities($r['company-id'])?></td>
                            <td><?=htmlentities(json_decode($r['service']))?></td>

                            <!-- php裡面是接收變數sid的數字 js用引數sid帶入   -->
                            <td><a href="javascript:delete_one(<?=$r['sid']?>)"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td><a href="bar_data_edit.php?sid=<?=$r['sid']?>"><i class="fas fa-edit"></i></a></td>
                        </tr>
                    <?php endforeach;?>

                    <!-- foreach($d_rows as $k=>$v){
                if($k==date('l')){
                    print_r($k);
                    print_r($v);
                    // echo implode(' ',$v);
                }
            }; -->

                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    //-----批次選取
    let checkAll = $('#checkAll'); //控制所有勾選的欄位
    let checkBoxes = $('tbody .checkboxeach input'); //其他勾選欄位

    checkAll.click(function() {
        for (let i = 0; i < checkBoxes.length; i++) {
            checkBoxes[i].checked = this.checked;
        }
    })
    //---------多重刪除
    function delete_all() {
        let sids = [];
        checkBoxes.each(function() {
            if ($(this).prop('checked')) {
                sids.push($(this).val())
            }
        });
        if (!sids.length) {
            alert('沒有選擇任何資料');
        } else {
            if (confirm('確定要刪除這些資料嗎？')) {
                location.href = 'bar_data_delete_all.php?sids=' + sids.toString();
            }

        }
    }
    //-------個別刪除
    function delete_one(sid) {
        if (confirm(`確定要刪除編號為${sid}的資料嗎?`)) {
            location.href = 'bar_data_delete.php?sid=' + sid;
        }
    };
   


</script>

<?php include '__html_foot.php'?>