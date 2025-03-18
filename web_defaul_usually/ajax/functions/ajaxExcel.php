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

if (!empty($_POST)) {

    $_TYPE = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
    $com = isset($_POST['com']) ? htmlspecialchars($_POST['com']) : '';
    $form = isset($_POST['form']) ? htmlspecialchars($_POST['form']) : '';
    $value = isset($_POST['value']) ? htmlspecialchars($_POST['value']) : '';

    if (!empty($_TYPE)) {
        switch ($com) {
            case 'baiviet':
                $sql_table = "baiviet";
                $title_sample_type = ["masp",  "giacu", "giaban"];
                $title_export_type = ["masp",  "giacu", "giaban"];
                break;
            default:
                break;
        }
        $where = "";
        switch ($form) {
            case 'sample':
                $data_key = $title_sample_type;
                $data_table[0] = array_fill(0, count($data_key), null);
                break;
            case 'export':
                if (!empty($value)) {
                    $where = " and id in (" . $value . ") ";
                }
                $sql = "select " . implode(",", $title_export_type) . " from #_" . $sql_table . " where 1 and type=? $where";
                $data_table = $db->rawQuery($sql, array($_TYPE));
                $data_key = $title_export_type;
                break;
            case 'import':
                $filePath = $_FILES['file']['tmp_name'];
                break;
            default:
                exit;
                break;
        }
    } else {
        exit;
    }
    $spreadsheet = new Spreadsheet();

    if (!empty($data_key)) {
        switch ($form) {
            case 'import':
                try {
                    // Đọc file Excel
                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = [];

                    // Lấy dữ liệu từ sheet (ví dụ lấy dữ liệu từ các dòng)
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowData = [];
                        foreach ($row->getCellIterator() as $cell) {
                            $rowData[] = $cell->getValue();  // Lấy giá trị mỗi ô
                        }
                        $data[] = $rowData;
                    }
                    if (count($data) > 1)
                        foreach ($data as $key => $value) {
                            if ($key != 0) {
                                if (!empty($value[0])) {
                                    $check_data = $db->rawQueryOne("select id from #_" . $sql_table . " where masp=? ", array($value[0]));
                                    if (!empty($check_data)) {
                                        $update = array();
                                        $sql_update = "";
                                        if (!empty($value[1])) {
                                            $update[] = "giacu=" . $value[1];
                                        }
                                        if (!empty($value[2])) {
                                            $update[] = "giaban=" . $value[2];
                                        }
                                        foreach ($update as $key_update => $value_update) {
                                            if ($key_update != 0) {
                                                $sql_update .= ",";
                                            }
                                            $sql_update .= $value_update;
                                        }
                                        $db->rawQueryOne("update table_" . $sql_table . " set $sql_update where masp=? ", array($value[0]));
                                    } else {
                                        $db->rawQueryOne("insert into table_" . $sql_table . " (ten_vi,masp,giaban,giacu,type,hienthi) values (?,?,?,?,?,0) ", array($value[0], $value[0], $value[1], $value[2], $_TYPE));
                                    }
                                }
                            }
                        }
                    // Trả về dữ liệu dưới dạng JSON (hoặc xử lý theo cách khác);
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit;
                } catch (Exception $e) {
                    echo json_encode(['error' => 'Lỗi khi đọc file Excel: ' . $e->getMessage()]);
                }
                break;
            default:
                // Tạo đối tượng Spreadsheet

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
                        switch ($value_column) {
                            case 'masp':
                                $sheet->setCellValue($col_title . '1', "Mã Sản Phẩm");
                                break;
                            case 'giaban':
                                $sheet->setCellValue($col_title . '1', "Giá Bán");
                                break;
                            case 'giacu':
                                $sheet->setCellValue($col_title . '1', "Giá Niêm Yết");
                                break;
                            case 'ten_vi':
                                $sheet->setCellValue($col_title . '1', "Tên Sản Phảm");
                                break;
                            case 'id_list':
                                $sheet->setCellValue($col_title . '1', "Danh mục cấp 1");
                                break;
                            case 'id_cat':
                                $sheet->setCellValue($col_title . '1', "Danh mục cấp 2");
                                break;
                            default:
                                break;
                        }

                        // Thêm hàng dưới tiêu đề
                        for ($i = 0; $i < count($data_table); $i++) {
                            switch ($value_column) {
                                case 'id_list':
                                    $info_list = $db->rawQueryOne("select ten_vi as ten from #_baiviet_list where id=? and type=?", array($data_table[$i][$value_column], $_TYPE));
                                    $sheet->setCellValue($col_title . ($i + 2), (!empty($info_list)) ? $info_list['ten'] : "");
                                    break;
                                case 'id_cat':
                                    $info_cat = $db->rawQueryOne("select ten_vi as ten from #_baiviet_cat where id=? and type=?", array($data_table[$i][$value_column], $_TYPE));
                                    $sheet->setCellValue($col_title . ($i + 2), !empty($info_cat) ? $info_cat['ten'] : "");
                                    break;
                                case 'giaban':
                                case 'giacu':
                                    $sheet->setCellValue($col_title . ($i + 2), $data_table[$i][$value_column]);
                                    $sheet->getStyle($col_title . ($i + 2))->getNumberFormat()->setFormatCode('#,##0');
                                    $sheet->getStyle($col_title . ($i + 2))->getFont()->getColor()->setRGB('FF0000');
                                    break;
                                default:
                                    $sheet->setCellValue($col_title . ($i + 2), $data_table[$i][$value_column]);
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
                break;
        }
    } else {
        echo json_encode(['error' => 'Lỗi dữ liệu chưa được cấu hình!: ' . $e->getMessage()]);
    }
    exit;
} else {
    exit;
}
