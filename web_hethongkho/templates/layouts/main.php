<?php
global $logo;
// order by
$orderbyForProduct = $func->getOrderByTypeFor('san-pham');
$orderbyForService = $func->getOrderByTypeFor('dich-vu');
$orderbyForBathroom = $func->getOrderByTypeFor('mau-nha-tam');
$pagingIndex =  $func->getPagingByComFor('index');
