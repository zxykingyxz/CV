<?php
$_SRC = (isset($_REQUEST['src'])) ? addslashes($_REQUEST['src']) : "";
$_TYPE = (isset($_REQUEST['type'])) ? addslashes($_REQUEST['type']) : "";
$_ACT = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";
// thống kê
$form = (isset($_POST['form'])) ? addslashes($_POST['form']) : "";
$value_c1 = (isset($_POST['value_c1'])) ? addslashes($_POST['value_c1']) : "";
$value_c2 = (isset($_POST['value_c2'])) ? addslashes($_POST['value_c2']) : "";
// phân trang
$page = (isset($_REQUEST['page'])) ? addslashes($_REQUEST['page']) : "";
// sắp xếp thứ tự
$sort = (isset($_REQUEST['sort'])) ? addslashes($_REQUEST['sort']) : "";
// param check
$array_param_data = ['status', 'city'];
$array_param_value = [];
if (!empty($array_param_data)) {
    foreach ($array_param_data as $value_param) {
        $$value_param = (isset($_REQUEST[$value_param])) ? addslashes($_REQUEST[$value_param]) : "";
        if (!empty($$value_param)) {
            $array_param_value[$value_param] = explode(",", $$value_param);
        } else {
            unset($$value_param);
        }
    }
}
$array_param_data_id = ['id_warehouse', 'id_supplier'];
$array_param_value_id = [];
if (!empty($array_param_data_id)) {
    foreach ($array_param_data_id as $value_param_id) {
        $$value_param_id = (isset($_REQUEST[$value_param_id])) ? addslashes($_REQUEST[$value_param_id]) : "";
        if (!empty($$value_param_id)) {
            $array_param_value_id[$value_param_id] = $$value_param_id;
        } else {
            unset($$value_param_id);
        }
    }
}

// từ khóa
$keywords_encode = (isset($_REQUEST['keywords'])) ? addslashes($_REQUEST['keywords']) : "";
$keywords = urldecode($keywords_encode);

$jv0 = 'javascript:void(0)';

// tên bảng 
$name_table_account = "warehouse_account";
$name_table_subaccount = "warehouse_subaccount";
$name_table_warehouse_notification = "warehouse_notification";
$name_table_warehouse_warehouse = "warehouse_warehouse";
$name_table_warehouse_product = "warehouse_product";
$name_table_warehouse_supplier = "warehouse_supplier";
$name_table_warehouse_customer = "warehouse_customer";
$name_table_warehouse_ship = "warehouse_ship";
$name_table_warehouse_check = "warehouse_check";
$name_table_warehouse_check_detail = "warehouse_check_detail";
$name_table_warehouse_expense = "warehouse_expense";
$name_table_warehouse_bill = "warehouse_bill";
$name_table_warehouse_bill_detail = "warehouse_bill_detail";
$name_table_warehouse_bill_goods = "warehouse_bill_goods";
$name_table_warehouse_bill_goods_detail = "warehouse_bill_goods_detail";
$name_table_warehouse_comments = "warehouse_comments";

// tên SESSION
$sessison_account_warehouse_tmp = "account_warehouse_tmp";
$sessison_account_warehouse = "account_warehouse";
$sessison_info_warehouse_tmp = "info_warehouse_tmp";
$sessison_status_load = "status_load";

// số lượng dữ liệu trong 1 trang 
$items_page = 7;
// thời gian tự động xóa file rác
$time_check_trash = time() - (30 * 24 * 60 * 60);
// các bảng cần check thùng rác
$tables_check_trash = [
    $name_table_subaccount => "Danh Sách Nhân Viên",
    $name_table_warehouse_warehouse => "Danh Sách Kho",
    $name_table_warehouse_product => "Danh Sách Sản Phẩm",
    $name_table_warehouse_supplier => "Nhà Cung Cấp",
    $name_table_warehouse_customer => "Khách Hàng",
    $name_table_warehouse_ship => "Đối Tác Vận Chuyển",
    $name_table_warehouse_bill => "Hóa Đơn",
    $name_table_warehouse_bill_goods => "Phiếu Nhập"
];
// truy vấn thông tin tài khoản
if (!empty($_SESSION[$sessison_account_warehouse])) {
    if ($_SESSION[$sessison_account_warehouse]['sub'] == false) {
        $table_account = $name_table_account;
    } else {
        $table_account = $name_table_subaccount;
    }
    $account_info = $db->rawQueryOne("select * from #_" . $table_account . " where id = '" . $_SESSION[$sessison_account_warehouse]['id'] . "' and trash<>true", array());
    // kiểm tra có phải lần đăng nhập đầu tiên trong ngày không
    $date_logged = $account_info['date_logged'];
    if (empty($date_logged) || ((date("d", $date_logged)) != date("d", time())) || ((date("m", $date_logged)) != date("m", time())) || ((date("Y", $date_logged)) != date("Y", time()))) {
        $db->rawQueryOne("update #_" . $table_account . " set date_logged=? where id = '" . $_SESSION[$sessison_account_warehouse]['id'] . "' and trash<>true", array(time()));
        // kiểm tra dữ liệu trong thùng rác quá 30 ngày
        $array_check_trash = [];
        $where_sql_check_trash = " date_trash<? and trash=true ";
        $orderby_sql_check_trash = " order by date_trash desc ";

        foreach ($tables_check_trash as $table => $table_label) {
            $table_check_trash = [];
            $table_check_trash = $db->rawQuery("select id from table_$table where " . $warehouse_func->getAccountParam()->sql . " and $where_sql_check_trash $orderby_sql_check_trash ", array($time_check_trash));
            if (!empty($table_check_trash)) {
                foreach ($table_check_trash as $key_trash => $value_trash) {
                    $array_check_trash[$table][] = $value_trash['id'];
                }
            }
        }
        if (!empty($array_check_trash)) {
            foreach ($array_check_trash as $key_check_trash => $value_check_trash) {
                $warehouse_func->delete_data($value_check_trash, 'delete', $key_check_trash);
            }
        }
    }
}

// Thông báo hiển thị
if (!empty($_SESSION[$sessison_status_load])) {
    $status_load = $_SESSION[$sessison_status_load];
    unset($_SESSION[$sessison_status_load]);
}
