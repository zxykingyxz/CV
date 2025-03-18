<?php
$folder = _upload_baiviet;

switch ($act) {
    case "man":
        $template = "baiviet/man/items";
        break;
    case "add":
        $template = "baiviet/man/item_add";
        break;
    default:
        break;
}
