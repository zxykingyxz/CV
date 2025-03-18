<?php

require_once 'ajaxConfig.php';

require_once _lib . 'PHPExcel/PHPExcel.php';

$listid = htmlspecialchars($_GET['listid']);

$arr_order_id = explode(',', $listid);

$vat = 0;

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator('Maarten Balliauw')->setLastModifiedBy('Maarten Balliauw')->setTitle('PHPExcel Test Document')->setSubject('PHPExcel Test Document')->setDescription('Test document for PHPExcel, generated using PHP classes.')->setKeywords('office PHPExcel php')->setCategory('Test result file');


$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);

$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);

$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);

$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);

$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);



$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(20);



$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'STT');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Mã đơn');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Thời gian đặt');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Họ tên');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Email');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Điện thoại');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Địa chỉ');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Tài liệu');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Tổng tiền');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Thành tiền');

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Trạng thái');



$styleA = array(

	'fill' => array(

		'type' => PHPExcel_Style_Fill::FILL_SOLID,

		'color' => array('rgb' => '3ec2cf')

	)

);



$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray(array('font' => array('color' => array('rgb' => '000000'), 'name' => 'Calibri', 'bold' => true, 'italic' => false, 'size' => 11), 'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true)));

$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleA);



$dataArrayList = array();

$position = 2;



$styleArray = array(

	'borders' => array(

		'allborders' => array(

			'style' => PHPExcel_Style_Border::BORDER_THIN

		),

	),

);

$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(20);

foreach ($arr_order_id as $k => $v) {

	$item_order = $db->rawQueryOne("select * from #_order where id=? order by id desc", array($v));

	$items_detail = $db->rawQuery("select * from #_order_detail where id_order=? order by id desc", array($v));

	$str_detail = '';

	foreach ($items_detail as $k1 => $v1) {

		$str_detail .= $v1['name'] . ', ';
	}

	$status_order = $config['order-status'][$item_order['order_status']]['name'];

	$dataArrayList[$k] = array(
		$k + 1,
		$item_order['code'],
		$item_order['createdAt'],
		$item_order['fullname'],
		$item_order['email'],
		$item_order['phone'],
		$item_order['address'],
		rtrim($str_detail, ', '),
		$item_order['total_price'] + $item_order['sale_off'],
		$item_order['total_price'],
		$status_order
	);

	$objPHPExcel->getActiveSheet()->getStyle('A' . $position . ':M' . $position)->applyFromArray(array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true)));



	$objPHPExcel->getActiveSheet()->getStyle('A' . $position . ':M' . $position)->applyFromArray($styleArray);

	$objPHPExcel->getActiveSheet()->getStyle('H' . $position . ':L' . $position)->getNumberFormat()->setFormatCode('#,##0');

	$objPHPExcel->getActiveSheet()->getStyle('H' . $position . ':L' . $position)->applyFromArray(array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT, 'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER, 'wrap' => true)));



	if ($position % 2 == 1) {

		$styleR = array(

			'fill' => array(

				'type' => PHPExcel_Style_Fill::FILL_SOLID,

				'color' => array('rgb' => 'c5ecf0')

			)

		);

		$objPHPExcel->getActiveSheet()->getStyle('A' . $position . ':M' . $position)->applyFromArray($styleR);
	} else {

		$styleR = array(

			'fill' => array(

				'type' => PHPExcel_Style_Fill::FILL_SOLID,

				'color' => array('rgb' => 'ffffff')

			)

		);

		$objPHPExcel->getActiveSheet()->getStyle('A' . $position . ':M' . $position)->applyFromArray($styleR);
	}



	$position += 1;
}

$objPHPExcel->getActiveSheet()->fromArray($dataArrayList, NULL, 'A2');



// $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFont()->setBold(true);

// $objPHPExcel->getActiveSheet()->setAutoFilter($objPHPExcel->getActiveSheet()->calculateWorksheetDimension());

$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="danh-sach-don-hang-' . date('dmY') . '.xlsx"');

header('Cache-Control: max-age=0');

// If you're serving to IE 9, then the following may be needed

header('Cache-Control: max-age=1');



// If you're serving to IE over SSL, then the following may be needed

header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified

header('Cache-Control: cache, must-revalidate'); // HTTP/1.1

header('Pragma: public'); // HTTP/1.0



$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

$objWriter->save('php://output');

exit;
