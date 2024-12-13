<?php if (!defined('_source')) die("Error");

include_once _source . "warehouse/table.php";
include_once _source . "warehouse/data.php";

if ((!in_array($_SRC, ['sign-up', 'login'])) && (!empty($_SESSION[$sessison_account_warehouse]))) {
    $_SESSION[$sessison_account_warehouse]['viewed_info'] = true;
}
switch ($_SRC) {
    case 'sign-up':
        include_once _source . "warehouse/sign_up.php";
        switch ($_ACT) {
            case 'man':
                $template = "warehouse/account/sign_up";
                break;
            case 'list':
                if (empty($_SESSION[$sessison_account_warehouse_tmp]['name']) || empty($_SESSION[$sessison_account_warehouse_tmp]['phone']) || empty($_SESSION[$sessison_account_warehouse_tmp]['email']) || empty($_SESSION[$sessison_account_warehouse_tmp]['city'])) {
                    $warehouse_func->transfer('Bạn chưa hoàn thành bước đăng ký đầu tiền', $url_sign_up_form, false);
                } else {
                    $template = "warehouse/account/sign_up_list";
                }
                break;
            case 'result':
                if (empty($_SESSION[$sessison_account_warehouse_tmp]['name']) || empty($_SESSION[$sessison_account_warehouse_tmp]['phone'])  || empty($_SESSION[$sessison_account_warehouse_tmp]['subdomain']) || empty($_SESSION[$sessison_account_warehouse_tmp]['password'])) {
                    if (empty($account_info)) {
                        $warehouse_func->transfer('Bạn chưa hoàn thành bước đăng ký đầu tiền', $url_sign_up_form, false);
                    } else {
                        $warehouse_func->transfer('Chào mừng bạn đến với hệ thống quản lý kho', $url_dashboard_man, true);
                    }
                } else {
                    $template = "warehouse/account/account_result";
                }
                break;
            default:
                $template = "warehouse/error/404";
                break;
        }
        break;
    case 'login':
        include_once _source . "warehouse/login.php";
        switch ($_ACT) {
            case 'man':
                $template = "warehouse/account/login";
                break;
            case 'forgot_password':
                $template = "warehouse/account/forgot_password";
                break;
            case 'result':
                if (empty($_SESSION[$sessison_account_warehouse_tmp]['name']) || empty($_SESSION[$sessison_account_warehouse_tmp]['phone'])  || empty($_SESSION[$sessison_account_warehouse_tmp]['subdomain']) || empty($_SESSION[$sessison_account_warehouse_tmp]['password'])) {
                    if (empty($account_info)) {
                        $warehouse_func->transfer('Bạn chưa hoàn thành xác thực', $url_sign_up_form, false);
                    } else {
                        $warehouse_func->transfer('Chào mừng bạn đến với hệ thống quản lý kho', $url_dashboard_man, true);
                    }
                } else {
                    $template = "warehouse/account/account_result";
                }
                break;
            default:
                $template = "warehouse/error/404";
                break;
        }
        break;

    case 'dashboard':
    case '':
        include_once _source . "warehouse/dashboard.php";
        $template = "warehouse/dashboard/dashboard";
        break;
    case 'warehouse':
        $template = "warehouse/list_default";
        switch ($_TYPE) {
            case 'warehouse':
                $main_table = $name_table_warehouse_warehouse;
                include_once _source . "warehouse/list_warehouse.php";
                break;
            case 'product':
                $main_table = $name_table_warehouse_product;
                include_once _source . "warehouse/list_product.php";
                break;
            default:
                $template = "warehouse/error/404";
                break;
        }
        break;
    case 'partner':
        $template = "warehouse/list_default";
        switch ($_TYPE) {
            case 'supplier':
                $main_table = $name_table_warehouse_supplier;
                break;
            case 'customer':
                $main_table = $name_table_warehouse_customer;
                break;
            case 'ship':
                $main_table = $name_table_warehouse_ship;
                break;
            default:
                $template = "warehouse/error/404";
                break;
        }
        include_once _source . "warehouse/list_partner.php";
        break;
    case 'transaction':
        switch ($_TYPE) {
            case 'import':
                $main_table = $name_table_warehouse_bill_goods;
                $sup_main_table = $name_table_warehouse_bill_goods_detail;
                include_once _source . "warehouse/import.php";
                switch ($_ACT) {
                    case 'man':
                        $template = "warehouse/list_default";
                        break;
                    case 'add':
                        $template = "warehouse/transaction/add_import";
                        break;
                    default:
                        break;
                }
                break;
            case 'export':
                $main_table = $name_table_warehouse_bill;
                $sup_main_table = $name_table_warehouse_bill_detail;
                include_once _source . "warehouse/export.php";
                switch ($_ACT) {
                    case 'man':
                        $template = "warehouse/list_default";
                        break;
                    case 'add':
                        $template = "warehouse/transaction/add_export";
                        break;
                    default:
                        break;
                }
                break;
            default:
                $template = "warehouse/error/404";
                break;
        }
        break;
    case 'trash':
        include_once _source . "warehouse/trash.php";
        $template = "warehouse/trash/list_trash";
        break;
    default:
        $template = "warehouse/error/404";
        break;
}

if (!empty($main_table)) {
    $data_html = $warehouse_func->handleFormTable($main_table, $items_page);
}

if (!empty($data_html)) {
    $html_table = $data_html->table;
    $paging_table = $data_html->paging;
    $html_ajax = [
        "table" => $html_table,
        "paging" => $paging_table,
    ];
}

if ($warehouse_func->isAjax()) {
    echo json_encode([
        'data' => $data_ajax,
        'html' => $html_ajax,
    ]);
    exit;
}
