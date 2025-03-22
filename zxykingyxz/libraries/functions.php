<?php
class functions
{
    private $db;
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function redirect($url = '')
    {
        echo '<script language="javascript">window.location = "' . $url . '" </script>';
        exit();
    }
    function createFolder($folderName)
    {
        $source_folder = $_SERVER['DOCUMENT_ROOT'] . "/";
        if (!file_exists($source_folder . $folderName)) {
            mkdir($source_folder . $folderName, 0777, true);
        }
    }
    function deleteFolder($folderName)
    {
        if (!is_dir($folderName)) {
            echo "Thư mục '$folderName' không tồn tại!";
            return false;
        }

        // Đệ quy xóa nội dung bên trong
        $files = array_diff(scandir($folderName), array('.', '..'));
        foreach ($files as $file) {
            $filePath = $folderName . DIRECTORY_SEPARATOR . $file;
            if (is_dir($filePath)) {
                $this->deleteFolder($filePath);
            } else {
                unlink($filePath);
            }
        }

        return rmdir($folderName);
    }
    public function addHrefImg($data = array())
    {
        global $config, $https_config;

        /* Defaults */
        $defaults = [
            'class' => '',
            'classfix' => '',
            'id' => '',
            'addhref' => false,
            'href' => '',
            'isLazy' => false,
            'data' => '',
            'rel' => 'dofollow',
            'role' => 'link',
            'target' => '',
            'prefix' => '',
            'size-error' => '',
            'size-src' => '',
            'sizes' => '',
            'actual_width' => 0,
            'url' => '',
            'upload' => '',
            'image' => '',
            'upload-error' => 'assets/images/',
            'image-error' => 'noimage.png',
            'alt' => ''
        ];

        /* Data */
        $info = array_merge($defaults, $data);

        list($width, $height, $zoom) = explode('x', $info['sizes']);
        if ((int)$info['actual_width'] > 0) {
            $height = (((int)$height * (int)$info['actual_width']) / (int)$width);
            $width = (int)$info['actual_width'];
            $info['sizes'] = (int)$width . "x" . (int)$height . "x" . (int)$zoom;
        }
        $style = '';
        switch ($zoom) {
            case 1:
                $style = 'object-fit:cover ;';
                break;
            case 2:
                $style = 'object-fit:contain ;';
                break;
            case 3:
                $style = 'object-fit:fill ;';
                break;
            default:
                break;
        }

        /* Upload - Image */
        if (empty($info['upload']) || empty($info['image'])) {
            $info['upload'] = $info['upload-error'];
            $info['image'] = $info['image-error'];
        }

        /* Size */
        if (!empty($info['sizes'])) {
            $info['size-error'] = $info['size-src'] = $info['sizes'];
        }

        /* Path origin */
        $urlImagesTmp = $info['upload'] . $info['image'];

        /* Path src */
        if (!empty($info['url'])) {
            $urlImages = $info['url'];
        } else {
            if (!empty($info['size-src'])) {
                $info['pathSize'] = $info['size-src'] . "/" . $urlImagesTmp;
                $urlImages = $https_config . $info['pathSize'];
            } else {
                $urlImages = $https_config . $urlImagesTmp;
            }
        }

        /* Path error */
        $urlImagesError =  $info['upload-error'] . $info['image-error'];

        /* target */
        $info['target'] = (!empty($info['target'])) ? "target='" . $info['target'] . "'" : "";

        /* Class */
        $info['class'] = ($info['isLazy']) ? $info['class'] . ' lazy ' : $info['class'];
        $info['class'] = (!empty($info['class'])) ? "class='" . $info['class'] . "'" : "";
        $info['classfix'] =  "class='load_website " . $info['classfix'] . "'";

        /* Id */
        $info['id'] = (!empty($info['id'])) ? "id='" . $info['id'] . "'" : "";

        /* Check to convert Webp */
        $info['hasURL'] = false;

        if (filter_var(str_replace($https_config, "", $urlImages), FILTER_VALIDATE_URL)) {
            $info['hasURL'] = true;
        }
        /* Src */
        if (file_exists($urlImages)) {
            $info['src'] =  "src='" . $urlImages . "'";
        } else {
            $info['src'] =  "src='" . $urlImagesError . "'";
        }

        /* add ahref */
        if ($info['addhref']) {
            $startHref = "<a href='" . $info['href'] . "' " . $info['classfix'] . " " . $info['target'] . " role='" . $info['role'] . "' rel='" . $info['rel'] . "' title='" . $info['alt'] . "' " . $info['data'] . " style='width: 100%;aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > ";
            $endHref = "</a>";
        } else {
            $startHref = "<div  " . $info['classfix'] . " style='width: 100%;aspect-ratio:$width/$height;max-width:" . $width . "px;display: inline-flex;justify-items: center;align-items: center;line-height: 0;position: relative;' > " . $info['data'] . "";
            $endHref = "</div>";
        }

        /* Image */
        $result = "{$startHref}<img width='{$width}' height='{$height}' " . $info['class'] . " " . $info['id'] . "  " . $info['src'] . " alt='" . $info['alt'] . "' style='position: absolute;  top: 50%;left: 50%;transform: translate(-50%, -50%);width: 100%;height: 100%;$style'/>{$endHref}";

        return $result;
    }
    public function checkLeftMenu($dataCheck = array())
    {
        global $_COM, $_SRC, $_TYPE, $_ACT;

        $data_default = [
            "com" => "",
            "src" => "",
            "type" => "",
        ];

        $infoCheck = array_merge($data_default, $dataCheck);

        foreach ($infoCheck as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'com':
                        if ($value != $_COM) {
                            return false;
                        }
                        break;
                    case 'src':
                        if ($value != $_SRC) {
                            return false;
                        }
                        break;
                    case 'type':
                        if ($value != $_TYPE) {
                            return false;
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        return true;
    }
    public function getUrlParam($dataParam = array())
    {
        $data_default = [
            "com" => "",
            "src" => "",
            "type" => "",
            "act" => "",
        ];

        $infoParam = array_merge($data_default, $dataParam);
        $array_param_url = [];

        foreach ($infoParam as $key => $value) {
            switch ($key) {
                case 'com':
                    if (!empty($value)) {
                        $url =  htmlspecialchars($value);
                    }
                    break;
                default:
                    if (!empty($value)) {
                        $array_param_url[$key] = htmlspecialchars($value);
                    }
                    break;
            }
        }
        $int_check = 0;
        foreach ($array_param_url as $key => $value) {
            if ($int_check == 0) {
                $url .= "?";
            } else {
                $url .= "&";
            }
            $url .= $key . "=" . $value;
            $int_check++;
        }
        return $url;
    }
    public function isAjax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'));
    }
    public function getDataNumber($value)
    {
        return (int)preg_replace("/[^0-9]/", "",  htmlspecialchars($value));
    }
    public function handleDataSaveDefault($data)
    {
        $send = [];
        if (!empty($data['text'])) {
            foreach ($data['text'] as $key => $value) {
                $send[$key] = htmlspecialchars($value);
            }
        }

        if (!empty($data['content'])) {
            foreach ($data['content'] as $key => $value) {
                $send[$key] = htmlspecialchars($value);
            }
        }

        if (!empty($data['date'])) {
            foreach ($data['date'] as $key => $value) {
                $send[$key] = strtotime(str_replace('/', '-', $value));
            }
        }

        if (!empty($data['number'])) {
            foreach ($data['number'] as $key => $value) {
                $send[$key] = $this->getDataNumber(htmlspecialchars($value));
            }
        }
        return $send;
    }
    public function saveDataDefault()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $_TYPE;
        global $array_param_value;


        if (isset($_POST) && !empty($_POST['save-data'])) {
            $id = (int)$_GET['id'];

            $data = $_POST['data'];

            $type_save = $_POST['save-data'];

            if (!empty($data)) {
                $send = [];

                $send = array_merge($send, $this->handleDataSaveDefault($data));

                if (!empty($data['array'])) {
                    foreach ($data['array'] as $key_array => $value_array) {
                        $info_save = [];
                        $info_save = array_merge($info_save, $this->handleDataSaveDefault($value_array));
                        $send[$key_array] = json_encode($info_save);
                    }
                }
            }
            if (!empty($id)) {
                $send['date_update'] = time();
                $this->db->where('id', $id);
                $updateData =  $this->db->update($_SRC, $send);
                if ($updateData) {
                    $response['status'] = 200;
                    $response['message'] = "Cập nhật dữ liệu thành công!";
                    $message = base64_encode(json_encode($response));

                    $url = $this->getUrlParam([
                        "com" => $_COM,
                        "src" => $_SRC,
                        'type' => $_TYPE,
                        "act" => ($type_save == "save") ? "man" : "edit",
                        "id" => ($type_save != "save") ? $id : "",
                        "page" => $array_param_value['page'],
                        "message" => $message,
                    ]);
                } else {
                    $response['status'] = 201;
                    $response['message'] = "Cập nhật dữ liệu không thành công!";
                    $message = base64_encode(json_encode($response));

                    $url = $this->getUrlParam([
                        "com" => $_COM,
                        "src" => $_SRC,
                        'type' => $_TYPE,
                        "act" => "man",
                        "page" => $array_param_value['page'],
                        "message" => $message,
                    ]);
                }
            } else {
                $send['date_created'] = time();
                $insertID =  $this->db->insert($_SRC, $send);
                if (!empty($insertID)) {
                    $response['status'] = 200;
                    $response['message'] = "Thêm dữ liệu thành công!";
                    $message = base64_encode(json_encode($response));

                    $url = $this->getUrlParam([
                        "com" => $_COM,
                        "src" => $_SRC,
                        'type' => $_TYPE,
                        "act" => ($type_save == "save") ? "man" : "edit",
                        "id" => ($type_save == "save-here") ? $insertID : "",
                        "page" => $array_param_value['page'],
                        "message" => $message,
                    ]);
                } else {
                    $response['status'] = 201;
                    $response['message'] = "Thêm dữ liệu không thành công!";
                    $message = base64_encode(json_encode($response));

                    $url = $this->getUrlParam([
                        "com" => $_COM,
                        "src" => $_SRC,
                        'type' => $_TYPE,
                        "act" => "man",
                        "page" => $array_param_value['page'],
                        "message" => $message,
                    ]);
                }
            }
        } else {

            $response['status'] = 201;
            $response['message'] = "Hệ thống đang bị lỗi vui lòng quay lại sau!";
            $message = base64_encode(json_encode($response));

            $url = $this->getUrlParam([
                "com" => $_COM,
                "src" => $_SRC,
                'type' => $_TYPE,
                "act" => "man",
                "page" => $array_param_value['page'],
                "message" => $message,
            ]);
        }
        $this->redirect($url);

        return true;
    }
    public function deleteDataDefault()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $_TYPE;
        global $array_param_value;

        $list_data = isset($_REQUEST['list_delete']) ? htmlspecialchars_decode($_REQUEST['list_delete']) : "";

        if (!empty($list_data)) {

            $this->db->rawQuery("delete from table_$_SRC where id in ($list_data) ", array());

            $data_check = $this->db->rawQuery("select id from table_$_SRC where id in ($list_data) ", array());

            if (empty($data_check)) {

                $response['status'] = 200;
                $response['message'] = "Xóa dữ liệu thành công!";

                $message = base64_encode(json_encode($response));
                $url = $this->getUrlParam([
                    "com" => $_COM,
                    "src" => $_SRC,
                    'type' => $_TYPE,
                    "act" =>  "man",
                    "page" => $array_param_value['page'],
                    "message" => $message,
                ]);
            } else {
                $response['status'] = 201;
                $response['message'] = "Xóa dữ liệu thất bại!";
                $message = base64_encode(json_encode($response));

                $url = $this->getUrlParam([
                    "com" => $_COM,
                    "src" => $_SRC,
                    'type' => $_TYPE,
                    "act" => "man",
                    "page" => $array_param_value['page'],
                    "message" => $message,
                ]);
            }
        } else {

            $response['status'] = 201;
            $response['message'] = "Bạn chưa chọn dữ liệu cần xóa!";
            $message = base64_encode(json_encode($response));

            $url = $this->getUrlParam([
                "com" => $_COM,
                "src" => $_SRC,
                'type' => $_TYPE,
                "act" => "man",
                "page" => $array_param_value['page'],
                "message" => $message,
            ]);
        }
        if ($this->isAjax()) {
            echo json_encode($response);
            exit;
        } else {
            $this->redirect($url);
        }
        return true;
    }
    public function getDataDetail()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $_TYPE;
        global $array_param_value;

        switch ($_COM) {
            case 'baocao':
            case 'ngansach':
                $id = isset($_GET['id']) ? (int)htmlspecialchars($_GET['id']) : "";

                if (!empty($id)) {
                    $data = $this->db->rawQueryOne("select * from table_$_SRC where id=$id ");
                } else {
                    $response['status'] = 201;
                    $response['message'] = "Không tìm thấy dữ liệu!";
                    $message = base64_encode(json_encode($response));

                    $url = $this->getUrlParam([
                        "com" => $_COM,
                        "src" => $_SRC,
                        "type" => $_TYPE,
                        "act" => "man",
                        "page" => $array_param_value['page'],
                        "message" => $message,
                    ]);
                    $this->redirect($url);
                }
                break;
            case 'settings':
                $data = $this->db->rawQueryOne("select * from table_$_SRC where type='$_TYPE' ");
                break;
            default:
                var_dump("Truy vấn chưa được cấu hình trong function getDataDetail");
                die;
                break;
        }

        return $data;
    }
    public function handleReportsNganSach()
    {

        $check_date_report = $this->db->rawQueryOne("select date_report from table_settings where type='ngan-sach' ");
        if (!empty($check_date_report)) {
            if (!empty($check_date_report['date_report'])) {
                $date_starts_reports = (int)$check_date_report['date_report'];
            } else {
                $date_starts_action = $this->db->rawQueryOne("select date_created from table_chitieu where 1 order by id asc");
                $date_starts_reports = (int)$date_starts_action['date_created'];
            }
        }
        if (!empty($date_starts_reports)) {
            $month_starts = date("m", $date_starts_reports);
            $year_starts = date("Y", $date_starts_reports);
            $month_current = date("m", time());
            $year_current = date("Y", time());
            if ($month_starts != $month_current || $year_starts != $year_current) {
            }
        }

        return true;
    }
    public function handleParamDateSql()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $array_param_value;

        $data_sql = "";
        $start_hour = ' 00:00:00';
        $end_hour = ' 23:59:59';

        $year = (!empty($array_param_value['year'])) ? htmlspecialchars($array_param_value['year']) : date('Y', time());

        switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $time_start = strtotime($year . '-1-1' . $start_hour);
                $time_end = strtotime($year . '-12-' . $daysInMonth . $end_hour);

                $data_sql = "(date_reports>=$time_start and date_reports<=$time_end)";
                break;
            case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                $month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

                $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                $time_start = strtotime($year . '-' . $month . '-1' . $start_hour);
                $time_end = strtotime($year . '-' . $month . '-' . $daysInMonth . $end_hour);

                $data_sql = "(date>=$time_start and date<=$time_end)";
                break;
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $time_start = strtotime($year . '-1-1' . $start_hour);
                $time_end = strtotime($year . '-12-31' . $end_hour);

                $data_sql = "(date_reports>=$time_start and date_reports<=$time_end)";
                break;
            default:
                break;
        }
        return $data_sql;
    }
    public function handleParamDefaultSql()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $array_param_value;
        // param
        $i_param = 0;
        $param_sql = '';
        if (!empty($array_param_value)) {
            foreach ($array_param_value as $key_param => $value_param) {
                if (!empty($value_param) && (in_array($key_param, ['keywords', 'status', 'loai', 'min_price', 'max_price']))) {

                    $param_sql .= ($i_param != 0) ? ' and ' : '';

                    switch ($key_param) {
                        case 'keywords':
                            $param_sql .= $this->getSqlWhereKeywords($value_param, ["title"]);
                            $i_param++;
                            break;
                        case 'status':
                            switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
                                case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                                    $param_sql .= "loai=$value_param";
                                    $i_param++;
                                    break;
                                default:
                                    break;
                            }
                            break;
                        case 'min_price':
                            switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
                                case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                                    $param_sql .= "price>=" . $this->getDataNumber($value_param);
                                    $i_param++;
                                    break;
                                default:
                                    break;
                            }
                            break;
                        case 'max_price':
                            switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
                                case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                                    $param_sql .= "price<=" . $this->getDataNumber($value_param);
                                    $i_param++;
                                    break;
                                default:
                                    break;
                            }
                            break;
                        case 'loai':
                            $param_sql .= "$key_param=$value_param";
                            $i_param++;
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        return ($i_param > 0) ? "($param_sql)" : "";
    }
    public function getDataDashboard()
    {
        global $config;
        global $array_param_value;

        $where = "";

        // Kiểm tra ngày tháng
        $start_hour = ' 00:00:00';
        $end_hour = ' 23:59:59';

        $year = (!empty($array_param_value['year'])) ? htmlspecialchars($array_param_value['year']) : date('Y', time());
        $month = (!empty($array_param_value['month'])) ? htmlspecialchars($array_param_value['month']) : date('m', time());

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $time_start = strtotime($year . '-' . $month . '-1' . $start_hour);
        $time_end = strtotime($year . '-' . $month . '-' . $daysInMonth . $end_hour);

        $sql_param_date = "(date>=$time_start and date<=$time_end)";

        if (!empty($sql_param_date)) {
            $where = " and " . $sql_param_date;
        }

        $order_by_ds = "order by date desc, id desc";

        // Truy vấn SQL an toàn
        $data_chitieu_chart = $this->db->rawQuery("select * from table_ngansach where 1 and type='chi-tieu' $where $order_by_ds");
        $data_thunhap_chart = $this->db->rawQuery("select * from table_ngansach where 1 and type='thu-nhap' $where $order_by_ds");

        $data_chitieu_chart_column = [];
        $data_chitieu_chart_pie = [];
        $data_thunhap_chart_column = [];
        $data_thunhap_chart_pie = [];

        // Hàm xử lý cộng dồn dữ liệu
        $processChartData = function ($data, &$column, &$pie) {
            foreach ($data as $item) {
                $date = $item['date'] ?? null;
                $type = $item['loai'] ?? null;
                $price = $item['price'] ?? 0;

                if ($date && $type) {
                    $column[$date][$type] = ($column[$date][$type] ?? 0) + $price;
                    $pie[$type] = ($pie[$type] ?? 0) + $price;
                }
            }
        };

        // Xử lý dữ liệu
        $processChartData($data_chitieu_chart, $data_chitieu_chart_column, $data_chitieu_chart_pie);
        $processChartData($data_thunhap_chart, $data_thunhap_chart_column, $data_thunhap_chart_pie);

        // Sắp xếp dữ liệu
        ksort($data_chitieu_chart_column);
        ksort($data_chitieu_chart_pie);
        ksort($data_thunhap_chart_column);
        ksort($data_thunhap_chart_pie);

        // Chuyển dữ liệu sang dạng JSON cho biểu đồ
        $formatPieData = function ($data, $name_data) {
            return json_encode(array_map(function ($key, $value) use ($name_data) {
                return [
                    'name' => $this->getTypeDataConfig($name_data, $key)['title'] ?? "Không xác định",
                    'y' => $value
                ];
            }, array_keys($data), $data), JSON_UNESCAPED_UNICODE);
        };

        // chuyển giá trị thành ngày
        $formatDayData = function ($data) {
            return json_encode(array_map(function ($value) {
                return date("d", $value);
            },  $data), JSON_UNESCAPED_UNICODE);
        };

        $data_chitieu_chart_pie = $formatPieData($data_chitieu_chart_pie, "chi-tieu");
        $data_thunhap_chart_pie = $formatPieData($data_thunhap_chart_pie, "thu-nhap");

        // chi tiêu column
        $after_handle_label_x_chitieu_chart_column = [];
        $after_handle_data_chitieu_chart_column = [];
        foreach ($config['data']['chi-tieu'] as $key_config => $value_config) {
            $data_Series = [];
            foreach ($data_chitieu_chart_column as $key_date => $value_date) {
                $data_Series[] = $value_date[$value_config['value']] ?? 0;
            }
            $after_handle_label_x_chitieu_chart_column = array_keys($data_chitieu_chart_column);
            $after_handle_data_chitieu_chart_column[] = [
                'name' => $value_config['title'],
                'data' => $data_Series,
            ];
        }

        // thu nhập column
        $after_handle_label_x_thunhap_chart_column = [];
        $after_handle_data_thunhap_chart_column = [];
        foreach ($config['data']['thu-nhap'] as $key_config => $value_config) {
            $data_Series = [];
            foreach ($data_thunhap_chart_column as $key_date => $value_date) {
                $data_Series[] = $value_date[$value_config['value']] ?? 0;
            }
            $after_handle_label_x_thunhap_chart_column = array_keys($data_thunhap_chart_column);
            $after_handle_data_thunhap_chart_column[] = [
                'name' => $value_config['title'],
                'data' => $data_Series,
            ];
        }

        // Tạo đối tượng kết quả
        $list_data = new stdClass();
        $list_data->chitieu_label_x_column_stacked = $formatDayData($after_handle_label_x_chitieu_chart_column);
        $list_data->thunhap_label_x_column_stacked = $formatDayData($after_handle_label_x_thunhap_chart_column);
        $list_data->chitieu_column_stacked = json_encode($after_handle_data_chitieu_chart_column, JSON_UNESCAPED_UNICODE);
        $list_data->thunhap_column_stacked = json_encode($after_handle_data_thunhap_chart_column, JSON_UNESCAPED_UNICODE);
        $list_data->chitieu_pie = $data_chitieu_chart_pie;
        $list_data->thunhap_pie = $data_thunhap_chart_pie;

        return $list_data;
    }
    public function getDataList()
    {
        global $_COM;
        global $_SRC;
        global $_ACT;
        global $_TYPE;
        global $config;
        global $array_param_value;

        // where
        $array_option_param = [];
        $where = "";

        // sắp xếp
        switch ($this->getUrlParam(["com" => $_COM, "act" => $_ACT, "src" => $_SRC])) {
            case $this->getUrlParam(["com" => 'ngansach', "act" => "man", "src" => "ngansach"]):
                $array_option_param[] = " type='$_TYPE' ";
                $order_by_ds = "order by date desc,id desc";
                break;
            case $this->getUrlParam(["com" => 'baocao', "act" => "man", "src" => "baocao"]):
                $array_option_param[] =  " type='$_TYPE' ";
                $order_by_ds = "order by date_reports desc,id desc";
                break;
            default:
                $order_by_ds = "order by id desc";
                break;
        }

        // kiểm tra ngày tháng
        $sql_param_date = $this->handleParamDateSql();
        if (!empty($sql_param_date)) {
            $array_option_param[] =  $sql_param_date;
        }

        // kiểm tra param default
        $sql_param_default = $this->handleParamDefaultSql();
        if (!empty($sql_param_default)) {
            $array_option_param[] =  $sql_param_default;
        }
        // end
        if (!empty($array_option_param)) {
            $where .= ' and (';
            // total option sql
            foreach ($array_option_param as $key_option_sql => $item_option_sql) {
                $where .= ($key_option_sql != 0) ? ' and ' : '';
                $where .=  $item_option_sql;
            }
            $where .= ')';
        }

        // phân trang
        $per_page = $config['website']['page'];
        $countPer = ((!empty($array_param_value['page']) ? $array_param_value['page'] : 1) * $per_page);
        $startpoint =  $countPer - $per_page;
        $data = $this->db->rawQuery("select * from table_$_SRC where 1 $where $order_by_ds limit $startpoint,$per_page");
        $total_data = $this->db->rawQueryOne("select COUNT(*) as total from table_$_SRC where  1 $where", array());

        $list_data = new stdClass();
        $list_data->data = $data;
        $list_data->total = $total_data['total'];
        $list_data->startpoint = $startpoint;

        return $list_data;
    }
    public function getTypeDataConfig($key_check, $value_check)
    {
        global $config;
        foreach ($config['data'][$key_check] as $key => $value) {
            if ($value['value'] == $value_check) {
                $data_info = $value;
                break;
            }
        }
        return $data_info;
    }
    public function formatMoney($value, $unit = '')
    {
        return number_format($value, 0, ',', '.') . " " . $unit;
    }
    public function getSqlWhereKeywords($keywords = null, $list = array())
    {
        global $config;
        $sql = "";
        if (!empty($keywords)) {
            $specialChars = ['=', '+', '@', '#', '$', '^', '&', '*', '(', ')', ';', '\'', '"', '\\', ',', '.', '<', '>', '?', '/'];
            $keywords = str_replace($specialChars, ' ', $keywords);
            switch ($config['website']['search']) {
                case 2:
                    $array_kw = explode(' ', $keywords);
                    $keywords_sql = '';
                    $i_keywords = 0;
                    foreach ($array_kw as $k_keywords => $v_keywords) {
                        if (!empty($v_keywords)) {
                            if ($i_keywords != 0) {
                                $keywords_sql .= '|';
                            }
                            $keywords_sql .= $v_keywords;
                            $i_keywords++;
                        }
                    }
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($key != 0) {
                                $sql .= " or ";
                            }
                            $sql .= "($value REGEXP '$keywords_sql')";
                        }
                        $sql .= ")";
                    }
                    break;
                case 3:
                    $array_kw = explode(' ', $keywords);
                    $i_keywords = 0;
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($i_keywords != 0) {
                                $sql .= " or ";
                            }
                            foreach ($array_kw as $k_keywords => $v_keywords) {
                                if ($k_keywords != 0) {
                                    $sql .= " and ";
                                }
                                $sql .= "($value LIKE '%$v_keywords%')";
                                $i_keywords++;
                            }
                        }
                        $sql .= ")";
                    }
                    break;
                default:
                    if (!empty($list)) {
                        $sql .= "(";
                        foreach ($list as $key => $value) {
                            if ($key != 0) {
                                $sql .= " or ";
                            }
                            $sql .= "($value LIKE '%$keywords%')";
                        }
                        $sql .= ")";
                    }
                    break;
            }
        }
        return $sql;
    }
}
