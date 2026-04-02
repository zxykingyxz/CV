<?php
global $holiday;

$data_holiday = $db->rawQuery("select day,month,title,type from table_ngayle where 1 ");

$data_show_holiday = [];
$time_check = (time() + $config['notification']['day_before_holiday'] * 24 * 60 * 60);
foreach ($data_holiday as $key => $value) {
    $date_check = 0;
    switch ($value['type']) {
        case 'duong-lich':
            $date_check = strtotime(str_replace('/', '-', ($value['day'] . "/" . $value['month'] . "/" . date("Y", time()))));
            break;
        case 'am-lich':
            // (int)$value['day'], (int)$value['month'], (int)date("Y", time())
            $date_handle = ($holiday->convertToSolar(2025, 3, 10));
            var_dump($date_handle);
            $date_check = strtotime(str_replace('/', '-', $date_handle[0] . "/" . $date_handle[1] . "/" . $date_handle[2]));
            break;
        default:
            break;
    }
    if ($date_check < $time_check && $date_check > time()) {
        $data_show_holiday[] = [
            "title" => $value['title'],
            "date" => $date_check,
            "come" => false,
        ];
    } else if ($date_check <= time() && ($date_check + ((24 * 60 * 60) - 1)) >= time()) {
        $data_show_holiday[] = [
            "title" => $value['title'],
            "date" => $date_check,
            "come" => true,
        ];
    }
}

?>
<?php if (!empty($data_show_holiday)) { ?>
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-4 <?= $class ?>">
        <?php foreach ($data_show_holiday as $key_holiday => $value_holiday) {
            $subject = (($value_holiday['com']) ? "Hôm nay là " : "Ngày " . date("d/m/Y", $value_holiday['date']) . " sắp tới là ") . $value_holiday['title'];
            $wish = ($value_holiday['com']) ? " Chúc bạn có một ngày lễ vui vẻ!" : "Chúc bạn một ngày làm việc thành công!";
        ?>
            <div class="relative cursor-pointer bg-white border-l-4 border-yellow-500 text-yellow-500 p-4 rounded-lg hover:bg-yellow-50 hover:shadow-xl transition-all duration-300 shadow-lg shadow-yellow-300/50">
                <div class="absolute top-0 right-0 mt-1 mr-1 text-3xl ">🎉</div>
                <h2 class="text-xl font-bold text-yellow-600">Thông báo ngày lễ</h2>
                <p class="mt-2 text-yellow-700"> <?= $subject ?></p>
                <p><?= $wish ?></p>
            </div>
        <?php } ?>
    </div>
<?php } ?>