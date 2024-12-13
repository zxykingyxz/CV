<?php
$com_url = $warehouse_func->getType('quan-ly-kho');
// đăng ký
$url_sign_up_form =  $com_url . '?src=sign-up&act=man';
$url_sign_up_list =  $com_url . '?src=sign-up&act=list';
$url_sign_up_result =  $com_url . '?src=sign-up&act=result';
// đăng nhập
$url_login_form =  $com_url . '?src=login&act=man';
$url_login_forgot_password =  $com_url . '?src=login&act=forgot_password';
$url_login_result =  $com_url . '?src=login&act=result';
// thống kê
$url_dashboard_man =  $com_url . '?src=dashboard&act=man';
// hàng hóa
$url_warehouse_trash =  $com_url . '?src=trash&act=man';
// hàng hóa
$url_warehouse_warehouse =  $com_url . '?src=warehouse&type=warehouse&act=man';
// chi tiết kho
$url_warehouse_product =  $com_url . '?src=warehouse&type=product&act=man';
// Nhà cung cấp
$url_partner_supplier =  $com_url . '?src=partner&type=supplier&act=man';
// Khách hàng 
$url_partner_customer =  $com_url . '?src=partner&type=customer&act=man';
// Đơn Vị Vận Chuyển
$url_partner_ship =  $com_url . '?src=partner&type=ship&act=man';
// Nhập Hàng
$url_transaction_import_man =  $com_url . '?src=transaction&type=import&act=man';
$url_transaction_import_add =  $com_url . '?src=transaction&type=import&act=add';
// Bán Hàng
$url_transaction_export_man =  $com_url . '?src=transaction&type=export&act=man';
$url_transaction_export_add =  $com_url . '?src=transaction&type=export&act=add';
