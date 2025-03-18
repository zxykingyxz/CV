<?php
$_SRC = (isset($_GET['src'])) ? htmlspecialchars($_GET['src']) : "";
$_ACT = (isset($_GET['act'])) ? htmlspecialchars($_GET['act']) : "";
$_TYPE = (isset($_GET['type'])) ? htmlspecialchars($_GET['type']) : "";

$array_param_data = ["keywords", "status", "loai", "month", "year", "page"];

$array_param_value = [];
if (!empty($array_param_data)) {
    foreach ($array_param_data as $value_param) {
        switch ($value_param) {
            default:
                $value_check = (isset($_REQUEST[$value_param])) ? addslashes($_REQUEST[$value_param]) : "";
                break;
        }
        if (!empty($value_check)) {
            $array_param_value[$value_param] = $value_check;
        }
        unset($value_check);
    }
}
