<?php

class handleTable
{

    private $_db;
    private $array_table = [];
    private $array_insert_table = [];

    private $type_id = " INT(11) AUTO_INCREMENT PRIMARY KEY ";

    function __construct($db)
    {
        $this->_db = $db;
    }
    // khai báo bảng
    public function setCreateTableSql($nameTable = null, $arrayColumn = array())
    {
        $this->array_table[$nameTable] = $arrayColumn;
    }
    // Thêm Dữ liệu vào bảng
    public function setInsertTableSql($nameTable = null, $arrayColumn = array())
    {
        $this->array_insert_table[$nameTable] = $arrayColumn;
    }
    // lấy kiểu trong bảng
    public function getSQlTypeColumn($typeColumn = null)
    {
        $value_column_collate = "COLLATE utf8mb4_unicode_ci";
        $value_column_default = "DEFAULT NULL";
        $column_type_table = [
            "subkey" => [
                "type" => "INT(11)",
                "data_attribute" => "",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "int" => [
                "type" => "INT(11)",
                "data_attribute" => "UNSIGNED",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "bigint" => [
                "type" => "BIGINT",
                "data_attribute" => "UNSIGNED",
                "collate" => "",
                "default" => $value_column_default,
            ],
            "var" => [
                "type" => "VARCHAR(255)",
                "data_attribute" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "text" => [
                "type" => "TEXT",
                "data_attribute" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "mediumtext" => [
                "type" => "MEDIUMTEXT",
                "data_attribute" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "longtext" => [
                "type" => "LONGTEXT",
                "data_attribute" => "",
                "collate" => $value_column_collate,
                "default" => $value_column_default,
            ],
            "boolean" => [
                "type" => "BOOLEAN",
                "data_attribute" => "",
                "collate" => "",
                "default" => "",
            ],
        ];
        if (empty($column_type_table[$typeColumn]) && !isset($column_type_table[$typeColumn])) {
            $column_type_table[$typeColumn] = $column_type_table["var"];
        }
        $data_return = new stdClass();
        $data_return->type = $column_type_table[$typeColumn]['type'];
        $data_return->data_attribute = $column_type_table[$typeColumn]['data_attribute'];
        $data_return->collate = $column_type_table[$typeColumn]['collate'];
        $data_return->default = $column_type_table[$typeColumn]['default'];
        return $data_return;
    }
    // kiểm tra bảng 
    public function checkColumnExists($tableName = null, $columnName = null)
    {
        global $config;
        if (empty($tableName) || empty($columnName)) {
            throw new InvalidArgumentException("Tên bảng và tên cột không được để trống.");
        }

        $query = "
            SELECT COLUMN_NAME 
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_SCHEMA = '" . $config['database']['dbname'] . "'
              AND TABLE_NAME = 'table_$tableName'
              AND COLUMN_NAME = '$columnName'
        ";

        // Sử dụng rawQueryOne thay vì prepare
        $stmt = $this->_db->rawQueryOne($query);

        // Kiểm tra kết quả trả về
        return !empty($stmt);
    }
    // tạo bảng
    public function createTable($tableName = null, $array_column = array())
    {
        $sql_table = "";
        $sql_table .= "CREATE TABLE " . $tableName . " (";
        $sql_table .= "id " . $this->type_id . ", ";
        foreach ($array_column as $column) {
            $type = $this->getParamColumn($column)->type;
            $sql_table .= $this->getParamColumn($column)->name . " " . $this->getSQlTypeColumn($type)->type . " " . $this->getSQlTypeColumn($type)->data_attribute . " " . $this->getSQlTypeColumn($type)->collate . " " . $this->getSQlTypeColumn($type)->default;
            if (end($array_column) !== $column) {
                $sql_table .= ", ";
            };
        }
        $sql_table .= ");";
        $this->_db->rawQueryOne($sql_table, array());
    }
    // kiểm tra bảng có tồn tại không
    public function checkTableExists($tableName = null)
    {
        $check_table = $this->_db->rawQueryOne("SHOW TABLES LIKE '" . $tableName . "';", array());
        return !empty($check_table);
    }
    // lấy pram được khi báo
    public function getParamColumn($itemsColumn = null)
    {
        if ((stripos($itemsColumn, "|") !== false) && preg_match('/^[a-zA-Z0-9|]+$/', $itemsColumn) === 1) {
            list($name, $type) = explode("|", $itemsColumn);
        } else {
            var_dump($itemsColumn . " không đúng định dạng!");
            var_dump("(khai báo phải theo kiểu column|type không khoản cách không viết dấu)");
            die;
        }
        $data_return = new stdClass();
        $data_return->name = $name;
        $data_return->type = $type;
        return  $data_return;
    }
    // xóa khóa chính trong bảng
    public function removePrimariKey($nameTable = null, $name_column_key = null)
    {
        $this->_db->rawQueryOne("ALTER TABLE " . $nameTable . " MODIFY " . $name_column_key . " INT;", array());
        $this->_db->rawQueryOne("ALTER TABLE " . $nameTable . " DROP PRIMARY KEY;", array());
    }
    // lấy các cột trong bảng
    public function getColumnTable($nameTable = null)
    {
        return $this->_db->rawQuery("SHOW COLUMNS FROM " . $nameTable . "", array());
    }
    // lấy các khóa chính trong bảng
    public function getPrimariKeyTable($nameTable = null)
    {
        return $this->_db->rawQueryOne("SHOW KEYS FROM " . $nameTable . " WHERE Key_name = 'PRIMARY'", array());
    }
    // kiểm tra dữ liệu có trong bảng chưa
    public function checkDataInTableSql($nameTable = null, $array_column = array(), $array_data = array())
    {
        $sql_table = "SELECT COUNT(*) AS TOTAL FROM " . $nameTable . " WHERE ";
        foreach ($array_column as $key => $column) {
            if (!empty($array_data[$key])) {
                if ($key != 0) {
                    $sql_table .= " AND ";
                }
                $sql_table .= " $column='" . $array_data[$key] . "' ";
            }
        }
        $check = $this->_db->rawQueryOne($sql_table, array());
        return !empty($check['TOTAL']);
    }
    // thêm dữ liệu vào bảng
    public function checkTypeColumnTable($nameTable = null, $array_type_column = array(), $array_data = array())
    {
        $errors = "";
        foreach ($array_type_column as $key => $type) {
            $value = $array_data[$key];
            if (!empty($array_data[$key]) && isset($array_data[$key])) {
                if (strpos($type, 'int') !== false) {
                    if (!filter_var($value, FILTER_VALIDATE_INT)) {
                        $errors = "Value '$value' in table '$nameTable' must be an integer.";
                    }
                } elseif (strpos($type, 'varchar') !== false || strpos($type, 'text') !== false) {
                    if (!is_string($value)) {
                        $errors = "Value '$value' in table '$nameTable' must be a string.";
                    }
                } elseif (strpos($type, 'decimal') !== false || strpos($type, 'float') !== false) {
                    if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
                        $errors = "Value '$value' in table '$nameTable' must be a float.";
                    }
                } elseif (strpos($type, 'date') !== false) {
                    if (!DateTime::createFromFormat('Y-m-d', $value)) {
                        $errors = "Value '$value' in table '$nameTable' must be a valid date (YYYY-MM-DD).";
                    }
                } elseif (strpos($type, 'datetime') !== false) {
                    if (!DateTime::createFromFormat('Y-m-d H:i:s', $value)) {
                        $errors = "Value '$value' in table '$nameTable' must be a valid datetime (YYYY-MM-DD HH:MM:SS).";
                    }
                } elseif (strpos($type, 'bool') !== false) {
                    if (!is_bool($value) && !in_array($value, [0, 1], true)) {
                        $errors = "Value '$value' in table '$nameTable' must be a boolean.";
                    }
                }
            }
            if (!empty($errors)) {
                var_dump($errors);
                die;
            }
        }
        return true;
    }
    // tạo và kiểm tra bảng
    public function autoCreateTable()
    {
        if (!empty($this->array_table)) {
            foreach ($this->array_table as $key_table => $value_table) {
                $array_name_column = [];
                $array_type_column = [];
                foreach ($value_table as $value_column) {
                    $array_name_column[] = $this->getParamColumn($value_column)->name;
                    $array_type_column[$this->getParamColumn($value_column)->name] = $this->getParamColumn($value_column)->type;
                }
                if (!$this->checkTableExists($key_table)) {
                    // Thêm bảng nếu bảng chưa tồn tại
                    $this->createTable($key_table, $value_table);
                } else {
                    // thêm id vào mảng
                    array_unshift($array_name_column, 'id');

                    // kiểm tra truy vấn
                    $table_show_column = $this->getColumnTable($key_table);
                    $table_show_key = $this->getPrimariKeyTable($key_table);
                    $resultArrayColumn = [];

                    // kiểm tra khóa chính trong bảng
                    if (!empty($table_show_key) && ($table_show_key["Column_name"] != 'id')) {
                        $this->removePrimariKey($key_table, $table_show_key["Column_name"]);
                    }

                    // xóa các cột không có trong data mà có trong bảng
                    // Đồng thời kiểm tra xem các cột có đúng với type đã khai báo không
                    foreach ($table_show_column as $item) {
                        if (!in_array($item['Field'], $array_name_column)) {
                            $this->_db->rawQueryOne("ALTER TABLE " . $key_table . " DROP COLUMN " . $item['Field'] . ";", array());
                        } else {
                            if ($item['Field'] == 'id') {
                                $isInt = stripos($item['Type'], 'INT') !== false;
                                $isAutoIncrement = stripos($item['Extra'], 'AUTO_INCREMENT') !== false;
                                $isPrimaryKey = stripos($item['Key'], 'PRI') !== false;
                                if (!$isInt || !$isAutoIncrement) {
                                    if (!$isPrimaryKey) {
                                        $this->_db->rawQueryOne("ALTER TABLE " . $key_table . " DROP PRIMARY KEY;", array());
                                    }
                                    $this->_db->rawQueryOne("ALTER TABLE " . $key_table . " MODIFY " . $item['Field'] . $this->type_id . " ;", array());
                                }
                            } else {
                                if (stripos($item['Type'], $this->getSQlTypeColumn($array_type_column[$item['Field']])->type) === false) {
                                    $this->_db->rawQueryOne("ALTER TABLE " . $key_table . " MODIFY " . $item['Field'] . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->type . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->data_attribute . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->collate . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->default . ";", array());
                                }
                            }
                            $resultArrayColumn[] = $item['Field'];
                        }
                    }
                    // kiểm tra số lượng cột và sắp xếp theo thứ tự
                    $total_column_check = count($array_name_column);
                    $total_column_search = count($resultArrayColumn);

                    if ($total_column_check >= $total_column_search) {
                        // thêm các cột còn thiếu vào bảng
                        foreach ($array_name_column as $column) {
                            $sql_add_column_detail = "";
                            if (!in_array($column, $resultArrayColumn)) {
                                if ($column == 'id') {
                                    $sql_add_column_detail .= "ALTER TABLE " . $key_table . " ADD COLUMN id " . $this->type_id . " FIRST;";
                                } else {
                                    $sql_add_column_detail .= "ALTER TABLE " . $key_table . " ";
                                    $sql_add_column_detail .= "ADD COLUMN " . $column . " " . $this->getSQlTypeColumn($array_type_column[$column])->type . " " . $this->getSQlTypeColumn($array_type_column[$column])->data_attribute . " " . $this->getSQlTypeColumn($array_type_column[$column])->collate . " " . $this->getSQlTypeColumn($array_type_column[$column])->default . " ";
                                    $sql_add_column_detail .= "AFTER  id;";
                                }
                                $this->_db->rawQueryOne($sql_add_column_detail, array());
                                $resultArrayColumn[] = $column;
                            }
                        }
                    }

                    // Sắp Xếp các cột trong bảng
                    if ($array_name_column !== $resultArrayColumn) {
                        $before_column = "";
                        for ($i = 0; $i < $total_column_check; $i++) {
                            $sql_table_detail = "";
                            $location_array_search = array_search($array_name_column[$i], $resultArrayColumn);
                            if ($i == 0 && ($resultArrayColumn[$i] != 'id')) {
                                // đổi vị trí đầu trong bảng
                                $sql_table_detail .= "ALTER TABLE " . $key_table . " CHANGE id id  INT AUTO_INCREMENT FIRST;";
                                $this->_db->rawQueryOne($sql_table_detail, array());
                                // đổi vị trí đầu trong chuổi kiểm tra
                                $location_id_table = array_search('id', $resultArrayColumn);
                                unset($resultArrayColumn[$location_id_table]);
                                array_unshift($resultArrayColumn, 'id');
                            } else {
                                if ($i != $location_array_search) {
                                    // đổi vị trí trong bảng
                                    $sql_table_detail .= "ALTER TABLE " . $key_table . " ";
                                    $sql_table_detail .= "CHANGE " . $array_name_column[$i] . " " . $array_name_column[$i] . " " . $this->getSQlTypeColumn($array_type_column[$array_name_column[$i]])->type . " ";
                                    $sql_table_detail .= "AFTER  "  . $before_column . ";";
                                    $this->_db->rawQueryOne($sql_table_detail, array());
                                    // đổi vị trí trong mảng
                                    unset($resultArrayColumn[$location_array_search]);
                                    $resultArrayColumn_tmp = [];
                                    foreach ($resultArrayColumn as $nameColumn) {
                                        if ($before_column == $nameColumn) {
                                            $resultArrayColumn_tmp[] = $array_name_column[$i];
                                        }
                                        $resultArrayColumn_tmp[] = $nameColumn;
                                    }
                                    $resultArrayColumn = $resultArrayColumn_tmp;
                                }
                            }
                            $before_column = $array_name_column[$i];
                        }
                    }

                    // thêm dữ liệu vào bảng
                }
            }
        }
    }

    // thêm dữ liệu vào bảng
    public function autoInsertTable()
    {
        if (!empty($this->array_insert_table)) {
            foreach ($this->array_insert_table as $key_table => $value_insert) {
                $sql_table = "";
                $table_show_column = $this->getColumnTable($key_table);
                if ($this->checkTableExists($key_table) && !empty($value_insert)) {
                    $array_name_column = [];
                    $array_type_column = [];
                    foreach ($table_show_column as $item) {
                        if ($item['Field'] != "id") {
                            $array_name_column[] = $item['Field'];
                            $array_type_column[] = $item['Type'];
                        }
                    }
                    foreach ($value_insert as $key_data => $array_data) {
                        if (!empty($array_data)) {
                            if ($key_data == 0) {
                                $sql_table .= "INSERT INTO $key_table (" . implode(",", $array_name_column) . ") VALUES";
                            }
                            $check_data = $this->checkDataInTableSql($key_table, $array_name_column, $array_data);
                            if (!$check_data) {
                                // kiểm tra có dữ liệu nào sai kiểu khai column không
                                $this->checkTypeColumnTable($key_table, $array_type_column, $array_data);
                                // xử lý các giá trị nếu thiếu hoặc dư
                                if (count($array_data) > count($array_name_column)) {
                                    $array_data = array_slice($array_data, 0, count($array_name_column));
                                } elseif (count($array_data) < count($array_name_column)) {
                                    while (count($array_data) < count($array_name_column)) {
                                        $array_data[] = null;
                                    }
                                }

                                $sql_table .= "('" . implode("','", $array_data) . "')";
                            }
                            if (count($value_insert) == ($key_data + 1)) {
                                $sql_table .= ";";
                            }
                            var_dump($sql_table);
                            die;
                        } else {
                            var_dump("Bảng $key_table có trường dữ liệu bị rổng!");
                            die;
                        }
                    }
                } else if (!$this->checkTableExists($key_table)) {
                    var_dump("Bảng $key_table không tồn tại!");
                    die;
                } else {
                    var_dump("Dữ liệu truyền vào đang rỗng!");
                    die;
                }
            }
        }
    }
    // auto xử lý 
    public function autoHandleTable()
    {
        $this->autoCreateTable();
        $this->autoInsertTable();

        $this->array_table = [];
        $this->array_insert_table = [];
    }
}
