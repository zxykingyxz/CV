<?php
require_once '../ajaxConfig.php';
require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Table\TableStyle;
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($func->isAjax() && isset($_POST)) {
    $form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
    $value = isset($_POST['value']) ? $_POST['value'] : '';
    if ($form == "modal") {
        $html['modal'] = $sample->getTemplateLayoutsFor([
            'name_layouts' => 'form_excel_modal',
            'link_modal' => $value,
        ]);
    } else {
        if (!empty($value)) {
            $data_excel = [];
            switch ($value) {
                case $func->getUrlParam(["com" => "ngansach", "src" => "ngansach", "type" => "chi-tieu", "act" => 'import']):
                    $table_sql = "chitieu";
                    $data_excel = [
                        [
                            "name_column" => "Tiêu đề",
                            "column" => "title",
                            "type" => "text",
                        ],
                        [
                            "name_column" => "Giá",
                            "column" => "price",
                            "type" => "price",
                        ],
                        [
                            "name_column" => "Loại chi tiêu",
                            "column" => "type",
                            "type" => "number",
                        ],
                        [
                            "name_column" => "Ngày chi tiêu",
                            "column" => "date",
                            "type" => "date",
                        ],
                        [
                            "name_column" => "Ghi chú",
                            "column" => "notes",
                            "type" => "content",
                        ]
                    ];
                    break;
                case $func->getUrlParam(["com" => "ngansach", "src" => "ngansach", "type" => "thu-nhap", "act" => 'import']):
                    $table_sql = "thunhap";
                    $data_excel = [
                        [
                            "name_column" => "Tiêu đề",
                            "column" => "title",
                            "type" => "text",
                        ],
                        [
                            "name_column" => "Giá",
                            "column" => "price",
                            "type" => "price",
                        ],
                        [
                            "name_column" => "Loại thu nhập",
                            "column" => "type",
                            "type" => "number",
                        ],
                        [
                            "name_column" => "Ngày nhận",
                            "column" => "date",
                            "type" => "date",
                        ],
                        [
                            "name_column" => "Ghi chú",
                            "column" => "notes",
                            "type" => "content",
                        ]
                    ];
                    break;
                default:
                    break;
            }
            if (!empty($data_excel)) {
                switch ($form) {
                    case 'sample':
                        $data_table[0] = array_fill(0, count($data_excel), null);
                        break;
                    case 'import':
                        $filePath = $_FILES['file']['tmp_name'];
                        break;
                    default:
                        break;
                }
            }
        } else {
            exit;
        }

        $spreadsheet = new Spreadsheet();

        if (!empty($data_excel) and $form != "import") {
            // Tạo đối tượng Spreadsheet

            // Sheet 1
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle("ListData");

            // Đặt tiêu đề cho bảng
            $col_title = '';
            foreach ($data_excel as $key_data => $value_data) {
                if (empty($col_title)) {
                    $col_title = 'A';
                } else {
                    // Tăng ký tự cột (ví dụ: từ A đến B, C,...)
                    $col_title++;
                }
                // Điền giá trị vào tiêu đề
                $sheet->setCellValue($col_title . '1', $value_data['name_column']);

                // Thêm hàng dưới tiêu đề
                for ($i = 0; $i < count($data_table); $i++) {
                    switch ($value_data['type']) {
                        case 'text':
                        case 'content':
                            $sheet->setCellValue($col_title . ($i + 2), (!empty($info_list)) ? $info_list['ten'] : "");
                            $sheet->setCellValueExplicit($col_title . ($i + 2), "", \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                            break;
                        case 'number':
                            $sheet->setCellValue($col_title . ($i + 2), 0);
                            $sheet->getStyle($col_title . ($i + 2))->getNumberFormat()->setFormatCode('0');
                            break;
                        case 'date':
                            $sheet->setCellValue($col_title . ($i + 2), date("d/m/Y", time()));
                            $sheet->getStyle($col_title . ($i + 2))->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                            $sheet->getStyle($col_title . ($i + 2))->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                            break;
                        case 'price':
                            $sheet->setCellValue($col_title . ($i + 2), 0);
                            $sheet->getStyle($col_title . ($i + 2))->getNumberFormat()->setFormatCode('#,##0" đ"');
                            $sheet->getStyle($col_title . ($i + 2))->getFont()->getColor()->setRGB('FF0000');
                            break;
                        default:
                            $sheet->setCellValue($col_title . ($i + 2), "");
                            break;
                    }
                }
                // Đặt chiều rộng cho cột tự động (Cách đơn giản để điều chỉnh chiều rộng cột)
                $sheet->getColumnDimension($col_title)->setAutoSize(true);
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
            exit;
        } else {
            try {
                // Đọc file Excel
                $spreadsheet = IOFactory::load($filePath);
                $sheet = $spreadsheet->getActiveSheet();
                $data_import = [];

                // Lấy dữ liệu từ sheet (ví dụ lấy dữ liệu từ các dòng)
                foreach ($sheet->getRowIterator() as $row) {
                    $rowData = [];
                    foreach ($row->getCellIterator() as $cell) {
                        if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                            // Nếu ô là ngày tháng, chuyển thành chuỗi định dạng YYYY-MM-DD
                            $dateValue = $cell->getValue();
                            $formattedDate = date('d/m/Y', \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($dateValue));
                            $rowData[] = $formattedDate;
                        } else {
                            // Nếu không phải ngày tháng, giữ nguyên giá trị
                            $rowData[] = $cell->getValue();
                        }
                    }
                    $data_import[] = $rowData;
                }


                if (count($data_import) > 1) {
                    $array_sql_value = [];
                    $sql_import = "";
                    foreach ($data_import as $key_import => $value_import) {
                        $data_handled = [];
                        if ($key_import != 0) {
                            foreach ($value_import as $key_data => $value_data) {
                                switch ($data_excel[$key_data]['type']) {
                                    case 'number':
                                    case 'price':
                                        $data_handled[] = !empty($value_data) ? $func->getDataNumber($value_data) : 0;
                                        break;
                                    case 'date':
                                        $data_handled[] = !empty($value_data) ? (int)strtotime(str_replace('/', '-', $value_data)) : time();
                                        break;
                                    default:
                                        $data_handled[] = !empty($value_data) ? "'" . htmlspecialchars($value_data) . "'" : "NULL";
                                        break;
                                }
                            }

                            $array_sql_value[] = "(" . implode(",", $data_handled) . ")";
                        }
                    }
                    $data_column = array_map(function ($value) {
                        return $value['column'];
                    }, $data_excel);

                    $sql_import .= "INSERT INTO table_$table_sql (" . implode(",", array_map(function ($col) {
                        return "`$col`";
                    }, $data_column)) . ") VALUES ";
                    $sql_import .= implode(",", $array_sql_value);
                    $sql_import .= ";";

                    $db->rawQueryOne($sql_import, array());
                    // Trả về dữ liệu dưới dạng JSON (hoặc xử lý theo cách khác);
                    echo json_encode(["data" => ["status" => 200, 'message' => "Thêm dữ liệu thành công:" . (count($data_import) - 1) . " dữ liệu "]]);
                    exit;
                } else {
                    echo json_encode(["data" => ["status" => 201, 'message' => 'Không có dữ liệu trong file!']]);
                    exit;
                }
            } catch (Exception $e) {
                echo json_encode(["data" => ["status" => 201, 'message' => 'Lỗi khi đọc file Excel: ' . $e->getMessage()]]);
                exit;
            }
        }
    }
    echo json_encode([
        'html' => $html,
        'data' => $data
    ]);
    exit;
} else {
    echo json_encode([
        'html' => $html,
        'data' => [
            "status" => 201,
            "message" => "Dữ liệu không được truyền đi!",
        ]
    ]);
    exit;
}
