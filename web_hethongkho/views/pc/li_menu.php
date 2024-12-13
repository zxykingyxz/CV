<?php
global $com, $source;
$check_active = ($com == $type || ($type == '' && $com == 'index')) ? ' active ' : '';
$heading = [2, 3, 4, 5];
$url = $func->getType($type);
$name = "";
$url_c = "";
#giao diện
$text_color = "text-black";
$text_color_level = "text-black";
$text_size_title = "text-base font-blod font-main-700";
$text_size_form = "text-sm font-medium font-main-500";
$padding_title = "px-2 py-2";
$padding_title_full = "px-2 py-1";

#Số Lượng Cột Menu Full
$number_colum = 4;

if ($level) {
    if ($isCheck) {
        $level_1 = $db->rawQuery("select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_baiviet where type=? and hienthi=1 order by stt asc, id desc", array($type));
    } else {
        $level_1 = $db->rawQuery("select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_baiviet_list where type=? and hienthi=1 order by stt asc, id desc", array($type));
        $sql_level_2 = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_baiviet_cat where type=? and id_list=? and hienthi=1 order by stt asc, id desc";
        $sql_level_3 = "select id,ten_$lang as ten,tenkhongdau_$lang as tenkhongdau from table_baiviet_item where type=? and id_cat=? and hienthi=1 order by stt asc, id desc";
    }
}
?>
<?php if ($full == false) { ?>
    <li class="group/list <?= (!empty($class_form)) ? $class_form : '' ?> <?= $check_active ?> relative ">
        <div class="  ">
            <?php if ($source == 'index') { ?>
                <h<?= $heading[0] ?>>
                <?php } ?>
                <a href="<?= $url ?>" rel="dofollow" role="link" aria-label="<?= $title ?>" title="<?= $title ?>" class="uppercase <?= $text_size_title . " " . $text_color ?>  group-hover/list:text-[var(--html-cl-website)] group-[&.active]/list:text-[var(--html-cl-website)]  inline-flex flex-wrap items-center justify-center transition-all duration-300 gap-[7px] px-2 py-1">
                    <span>
                        <?= $title ?>
                    </span>
                    <?php if ($level && !empty($level_1)) { ?>
                        <i class="fas fa-sort-down block h-2 leading-[0]"></i>
                    <?php } ?>
                </a>
                <?php if ($source == 'index') { ?>
                </h<?= $heading[0] ?>>
            <?php } ?>
            <?php if (!empty($level_1)) { ?>
                <div class=" opacity-0 invisible scale-95 group-hover/list:opacity-100 group-hover/list:visible group-hover/list:scale-100 top-full left-0 w-full min-w-[250px]  shadow-lg shadow-gray-400  bg-white absolute inline-flex flex-wrap items-center transition-all duration-300 z-10">
                    <?php foreach ($level_1 as $key_c1 => $value_c1) {
                        $name = (isset($value_c1["ten_$lang"])) ? $value_c1["ten_$lang"] : $value_c1["ten"];
                    ?>
                        <div class="group/cat w-full relative  last:border-none border-b  border-gray-200 ">
                            <?php if ($source == 'index') { ?>
                                <h<?= $heading[1] ?>>
                                <?php } ?>
                                <a href="<?= $func->getUrl($value_c1) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" <?= $text_color_level . " " . $text_size_form  ?> bg-white hover:text-white group-hover/cat:bg-[var(--html-cl-website)] group-hover/cat:text-white w-full inline-flex items-center gap-2 <?= $padding_title ?> transition-all duration-300">
                                    <span>
                                        <?= $name ?>
                                    </span>
                                </a>
                                <?php if ($source == 'index') { ?>
                                </h<?= $heading[1] ?>>
                            <?php } ?>
                            <?php
                            if (isset($sql_level_2) && !empty($sql_level_2)) {
                                $level_2 = $db->rawQuery($sql_level_2, array($type, $value_c1['id']));
                            }
                            if (!empty($level_2)) { ?>
                                <div class=" opacity-0 invisible scale-95 group-hover/cat:opacity-100 group-hover/cat:visible group-hover/cat:scale-100 top-0 left-full w-full min-w-[200px] shadow-lg shadow-gray-400 bg-white absolute inline-flex flex-wrap items-center transition-all duration-300 z-10">
                                    <?php foreach ($level_2 as $key_c2 => $value_c2) {
                                        $name = (isset($value_c2["ten_$lang"])) ? $value_c2["ten_$lang"] : $value_c2["ten"];
                                    ?>
                                        <div class="w-full group/item relative last:border-none border-b  border-gray-200 ">
                                            <?php if ($source == 'index') { ?>
                                                <h<?= $heading[2] ?>>
                                                <?php } ?>
                                                <a href="<?= $func->getUrl($value_c2) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" <?= $text_color_level . " " . $text_size_form  ?> bg-white hover:text-white hover:bg-[var(--html-cl-website)] group-hover/item:text-white group-hover/item:bg-[var(--html-cl-website)] w-full inline-flex items-center gap-2 <?= $padding_title ?> transition-all duration-300">
                                                    <span>
                                                        <?= $name ?>
                                                    </span>
                                                </a>
                                                <?php if ($source == 'index') { ?>
                                                </h<?= $heading[2] ?>>
                                            <?php } ?>
                                            <?php
                                            if (isset($sql_level_3) && !empty($sql_level_3)) {
                                                $level_3 = $db->rawQuery($sql_level_3, array($type, $value_c2['id']));
                                            }
                                            if (!empty($level_3)) { ?>
                                                <div class=" opacity-0 invisible scale-95 group-hover/item:opacity-100 group-hover/item:visible group-hover/item:scale-100 top-0 left-full w-full min-w-[200px]  shadow-lg shadow-gray-400 bg-white absolute inline-flex flex-wrap items-center transition-all duration-300 z-10">
                                                    <?php foreach ($level_3 as $key_c3 => $value_c3) {
                                                        $name = (isset($value_c3["ten_$lang"])) ? $value_c3["ten_$lang"] : $value_c3["ten"];
                                                    ?>
                                                        <div class="w-full relative last:border-none border-b  border-gray-200 ">
                                                            <?php if ($source == 'index') { ?>
                                                                <h<?= $heading[3] ?>>
                                                                <?php } ?>
                                                                <a href="<?= $func->getUrl($value_c3) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" <?= $text_color_level . " " . $text_size_form  ?> bg-white  hover:text-white hover:bg-[var(--html-cl-website)]  w-full inline-flex items-center gap-2 <?= $padding_title ?> transition-all duration-300">
                                                                    <span>
                                                                        <?= $name ?>
                                                                    </span>
                                                                </a>
                                                                <?php if ($source == 'index') { ?>
                                                                </h<?= $heading[3] ?>>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </li>
<?php } else { ?>
    <li class="<?= (!empty($class_form)) ? $class_form : '' ?> <?= $check_active ?>">
        <div class="group/list peer/list ">
            <div class="relative">
                <?php if ($source == 'index') { ?>
                    <h<?= $heading[0] ?>>
                    <?php } ?>
                    <a href="<?= $url ?>" rel="dofollow" role="link" aria-label="<?= $title ?>" title="<?= $title ?>" class=" <?= $text_color . " " . $text_size_title  ?> group-hover/list:text-[var(--html-cl-website)]  inline-flex flex-wrap items-center justify-center transition-all duration-300 gap-3 px-2 py-1">
                        <span>
                            <?= $title ?>
                        </span>
                    </a>
                    <?php if ($source == 'index') { ?>
                    </h<?= $heading[0] ?>>
                <?php } ?>
                <div class="absolute top-full left-0 w-full h-[100px] opacity-0 invisible group-hover/list:visible z-20"></div>
            </div>
            <?php
            if (!empty($level_1)) {
                $total_ds = (count($level_1));
                if (($total_ds % $number_colum) > 0) {
                    $max_list = intval($total_ds / $number_colum) + 1;
                } else {
                    $max_list = intval($total_ds / $number_colum);
                }
                switch ($number_colum) {
                    case 1:
                        $class_list = " grid-cols-1 ";
                        break;
                    case 2:
                        $class_list = " grid-cols-2 ";
                        break;
                    case 3:
                        $class_list = " grid-cols-3 ";
                        break;
                    case 4:
                        $class_list = " grid-cols-4 ";
                        break;
                    case 5:
                        $class_list = " grid-cols-5 ";
                        break;
                    default:
                        break;
                }
            ?>
                <div class=" opacity-0 invisible scale-95 group-hover/list:opacity-100 group-hover/list:visible group-hover/list:scale-100 top-full left-0 w-full min-w-[200px] rounded shadow-lg shadow-gray-400 bg-white absolute inline-flex flex-wrap items-center transition-all duration-300 z-20 py-2 px-2 scroll-y  max-h-[400px] overflow-x-hidden overflow-y-auto">
                    <div class="flex-1 grid <?= $class_list ?> gap-6">
                        <?php
                        for ($i = 0; $i < $number_colum; $i++) {
                        ?>
                            <div class="grid grid-cols-1 gap-[2px] content-start">
                                <?php
                                for ($i_list = 0; $i_list < $max_list; $i_list++) {
                                    $value_c1 = $level_1[($i + ($i_list * $number_colum))];
                                    $name = (isset($value_c1["ten_$lang"])) ? $value_c1["ten_$lang"] : $value_c1["ten"];
                                    if (!empty($value_c1)) {
                                ?>
                                        <div>
                                            <?php if ($source == 'index') { ?>
                                                <h<?= $heading[1] ?>>
                                                <?php } ?>
                                                <a href="<?= $func->getUrl($value_c1) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" group/item <?= $text_color_level . " " . $text_size_form  ?> bg-white hover:text-white w-full inline-flex items-center gap-2 <?= $padding_title_full ?> transition-all duration-300 relative z-10 ">
                                                    <div class="group-hover/item:w-full group-hover/item:h-full z-[-1] absolute top-1/2 translate-y-[-50%] left-0 h-[60%] w-0 bg-[var(--html-cl-website)] border-l-[3px] border-[var(--html-cl-website)] transition-all duration-300"></div>
                                                    <span>
                                                        <?= $name ?>
                                                    </span>
                                                </a>
                                                <?php if ($source == 'index') { ?>
                                                </h<?= $heading[1] ?>>
                                            <?php } ?>
                                        </div>
                                        <?php
                                        $level_2 = $db->rawQuery($sql_level_2, array($type, $value_c1['id']));
                                        if (!empty($level_2)) { ?>
                                            <?php foreach ($level_2 as $key_c2 => $value_c2) {
                                                $name = (isset($value_c2["ten_$lang"])) ? $value_c2["ten_$lang"] : $value_c2["ten"];
                                            ?>
                                                <div>
                                                    <?php if ($source == 'index') { ?>
                                                        <h<?= $heading[2] ?>>
                                                        <?php } ?>
                                                        <a href="<?= $func->getUrl($value_c2) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" group/item  <?= $text_color_level . " " . $text_size_form  ?> bg-white  hover:text-white w-full inline-flex items-center gap-2 <?= $padding_title_full ?> transition-all duration-300 relative z-10 ml-2">
                                                            <div class="group-hover/item:w-full group-hover/item:h-full group-hover/item:rounded-none z-[-1]  absolute top-1/2 translate-y-[-50%] left-0 h-1 w-1 rounded-xl bg-[var(--html-cl-website)] transition-all duration-300"></div>
                                                            <span>
                                                                <?= $name ?>
                                                            </span>
                                                        </a>
                                                        <?php if ($source == 'index') { ?>
                                                        </h<?= $heading[2] ?>>
                                                    <?php } ?>
                                                </div>
                                                <?php
                                                $level_3 = $db->rawQuery($sql_level_3, array($type, $value_c2['id']));
                                                if (!empty($level_3)) { ?>
                                                    <?php foreach ($level_3 as $key_c3 => $value_c3) {
                                                        $name = (isset($value_c3["ten_$lang"])) ? $value_c3["ten_$lang"] : $value_c3["ten"];
                                                    ?>
                                                        <div>
                                                            <?php if ($source == 'index') { ?>
                                                                <h<?= $heading[3] ?>>
                                                                <?php } ?>
                                                                <a href="<?= $func->getUrl($value_c3) ?>" rel="dofollow" role="link" aria-label="<?= $name ?>" title="<?= $name ?>" class=" group/item <?= $text_color_level . " " . $text_size_form ?> bg-white hover:text-white w-full inline-flex items-center gap-2 <?= $padding_title_full ?> transition-all duration-300 relative z-10 ml-3">
                                                                    <div class="group-hover/item:w-full group-hover/item:h-full group-hover/item:rounded-none z-[-1]  absolute top-1/2 translate-y-[-50%] left-0 h-0 w-0 rounded-xl bg-[var(--html-cl-website)] transition-all duration-300"></div>
                                                                    <span>
                                                                        <?= $name ?>
                                                                    </span>
                                                                </a>
                                                                <?php if ($source == 'index') { ?>
                                                                </h<?= $heading[3] ?>>
                                                            <?php } ?>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php  } ?>
                                <?php  } ?>
                            </div>
                        <?php  } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if (!empty($level_1)) { ?>
            <div class="fixed top-0 left-0 w-full h-full bg-[#000000a8] opacity-0 invisible peer-hover/list:visible peer-hover/list:opacity-100 z-[-1] transition-all duration-300 cursor-none"></div>
        <?php } ?>
    </li>
<?php } ?>