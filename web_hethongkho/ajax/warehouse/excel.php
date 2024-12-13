<?php
require_once '../ajaxConfig.php';
require_once _lib . "warehouse/warehouse_function.php";
$warehouse_func = new warehouse_function();
require_once _lib . "warehouse/warehouse_url.php";
require_once _source . "warehouse/data.php";
require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;


if (!empty($_POST)) {
    @$_SRC = isset($_POST['src']) ? htmlspecialchars($_POST['src']) : '';
    @$_ACT = isset($_POST['act']) ? htmlspecialchars($_POST['act']) : '';
    @$_TYPE = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
    @$form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
    @$data = isset($_POST['data']) ? htmlspecialchars($_POST['data']) : '';

    if (!empty($_SRC)) {
        switch ($_SRC) {
            case 'warehouse':
                switch ($_TYPE) {
                    case 'warehouse':
                        $sql_table = $name_table_warehouse_warehouse;
                        $title_sample_type = ["name", "code", "address", "max_quantity"];
                        break;
                    case 'product':
                        $sql_table = $name_table_warehouse_product;
                        break;
                    default:
                        break;
                }
                break;
            case 'partner':
                switch ($_TYPE) {
                    case 'supplier':
                        $sql_table = $name_table_warehouse_supplier;
                        break;
                    case 'customer':
                        $sql_table = $name_table_warehouse_customer;
                        break;
                    case 'ship':
                        $sql_table = $name_table_warehouse_ship;
                        break;
                    default:
                        break;
                }
                break;
            case 'transaction':
                switch ($_TYPE) {
                    case 'import':
                        $sql_table = $name_table_warehouse_bill_goods;
                        break;
                    case 'export':
                        $sql_table = $name_table_warehouse_bill;
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        switch ($form) {
            case 'sample':
                $data_key = $title_sample_type;
                $data_table[0] = array_fill(0, count($data_key), null);
                break;
            case 'export':
                if (!empty($data)) {
                    $data = str_replace(",", "|", $data);
                } else {
                    exit;
                }
                $sql = "select * from #_" . $sql_table . " where 1 and (id REGEXP '$data' )";
                $data_table = $db->rawQuery($sql, array());
                $data_key = array_keys($data_table[0]);
                break;
            case 'import':

                break;
            default:
                exit;
                break;
        }
    } else {
        exit;
    }
    if (!empty($data_key)) {
        // Tạo đối tượng Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Sheet 1
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("ListData");

        // Đặt tiêu đề cho bảng
        $col_title = '';
        foreach ($data_key as $key_column => $value_column) {
            if (!in_array($value_column, ['id_owner', 'id', 'thumb', 'data_trashed', 'trash', 'date_trash'])) {
                if (empty($col_title)) {
                    $col_title = 'A';
                } else {
                    // Tăng ký tự cột (ví dụ: từ A đến B, C,...)
                    $col_title++;
                }
                // Điền giá trị vào tiêu đề
                $sheet->setCellValue($col_title . '1', $warehouse_func->value_handing_column($value_column));

                // Thêm hàng dưới tiêu đề
                for ($i = 0; $i < count($data_table); $i++) {
                    $sheet->setCellValue($col_title . ($i + 2), $warehouse_func->value_handing_column($value_column, $data_table[$i]));
                    switch ($value_column) {
                        case 'photo':
                            $sheet->getCell($col_title . ($i + 2))->getHyperlink()->setUrl($warehouse_func->value_handing_column($value_column, $data_table[$i]));
                            $sheet->getStyle($col_title . ($i + 2))->getFont()->getColor()->setRGB('0000FF');
                            break;
                        case 'max_quantity':
                        case 'quantity':
                        case 'min_quantity':
                        case 'sale_price':
                        case 'capital_price':
                            $sheet->getStyle($col_title . ($i + 2))->getNumberFormat()->setFormatCode('#,##0');
                            $sheet->getStyle($col_title . ($i + 2))->getFont()->getColor()->setRGB('FF0000');
                            break;
                        default:
                            break;
                    }
                }
                // Đặt chiều rộng cho cột tự động (Cách đơn giản để điều chỉnh chiều rộng cột)
                $sheet->getColumnDimension($col_title)->setAutoSize(true);
            }
        }
        $table = new Table();
        $table->setName('TableData'); // Tên bảng
        $table->setRange('A1:' . $col_title . (count($data_table) + 1)); // Phạm vi bảng (bao gồm cả tiêu đề)
        $tableStyle = new TableStyle('TableStyleMedium9');
        // Áp dụng TableStyle vào bảng
        $table->setStyle($tableStyle);

        // Thêm bảng vào worksheet
        $sheet->addTable($table);

        // cố định hàng đầu tiên
        $sheet->freezePane('A2');
        // Thiết lập đường viền cho toàn bộ bảng
        $sheet->getStyle('A1:' . $col_title . (count($data_table) + 1))->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);  // Đường viền mỏng cho toàn bộ bảng

        // Tạo kiểu cho tiêu đề bảng
        $sheet->getStyle("A1:" . $col_title . "1")->getFont()->setBold(true);  // In đậm tiêu đề
        $sheet->getStyle("A1:" . $col_title . "1")->getFont()->getColor()->setRGB('FFFFFF'); // màu chữ
        $sheet->getStyle("A1:" . $col_title . "1")->getFont()->setSize(12); //font chữ
        $sheet->getStyle("A1:" . $col_title . '1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);  // Căn giữa theo chiều ngang
        $sheet->getStyle("A1:" . $col_title . (count($data_table) + 1))->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);     // Căn giữa theo chiều dọc
        for ($row = 1; $row <= (count($data_table) + 1); $row++) {
            $sheet->getRowDimension($row)->setRowHeight(26); // Chiều cao của từng hàng là 30
        }
        // Thiết lập header cho file Excel để trình duyệt tải xuống
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data.xlsx"');
        header('Cache-Control: max-age=0');

        // Tạo file Excel và trả về qua php://output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output'); // Trả về file mà không lưu trên server
    }
    exit;
}
