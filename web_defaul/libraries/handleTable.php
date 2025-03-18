<?php

class handleTable
{

    private $_db;
    private $array_table = [];
    private $array_insert_table = [];
    private $array_truncate_table = [];
    private $cacheFile = '/dataTableCache.json';


    private $type_id = " INT(11) AUTO_INCREMENT PRIMARY KEY ";
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $charset;

    public function __construct($host, $dbname, $username, $password, $charset = 'utf8mb4')
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    // ============== kết nối database =============
    // kết nối
    public function connect()
    {
        if ($this->_db !== null) {
            return $this->_db;
        }

        try {
            $this->_db = new PDO($this->getDsn(), $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
            ]);
        } catch (PDOException $e) {
            error_log("Database connection error: " . $e->getMessage());
            throw new RuntimeException("Không thể kết nối cơ sở dữ liệu. Vui lòng thử lại sau.");
        }

        return $this->_db;
    }

    private function getDsn(): string
    {
        return "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
    }
    // đóng kết nối
    public function close()
    {
        $this->_db = null;
    }
    // =================== end =====================

    // ============= Hàm Truy vấn dữ liệu trong database ================
    // truy vấn một
    public function rawQueryOne($sql, $params = [])
    {
        try {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->_db->prepare($sql);

            // Liên kết các tham số nếu có
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            // Thực thi câu lệnh
            $stmt->execute();

            // Nếu là SELECT, lấy và trả về kết quả
            if (preg_match('/^(SELECT|SHOW)/i', $sql)) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ?: false; // Trả về dòng đầu tiên hoặc false nếu không có dữ liệu
            } else {
                // Trả về true nếu câu lệnh UPDATE/INSERT/DELETE thành công
                return $stmt->rowCount() > 0;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            // Xử lý lỗi
            return false;
        }
    }
    // truy vấn nhiều
    public function rawQuery($sql, $params = [])
    {
        try {
            // Chuẩn bị câu lệnh SQL
            $stmt = $this->_db->prepare($sql);

            // Liên kết các tham số nếu có
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            // Thực thi truy vấn
            $stmt->execute();

            // Kiểm tra nếu là SELECT
            if (preg_match('/^(SELECT|SHOW)/i', $sql)) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result ?: false; // Trả về tất cả kết quả hoặc false nếu không có dữ liệu
            } else {
                // Trả về true nếu câu lệnh UPDATE/INSERT/DELETE thành công
                return $stmt->rowCount() > 0;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            // Xử lý lỗi
            return false;
        }
    }
    // ============================ end =============================

    // ================= Các Hàm bổ trợ xử lý dữ liệu =================
    // save cache
    public function saveCache($data)
    {
        $result = file_put_contents($_SERVER["DOCUMENT_ROOT"] . $this->cacheFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    // Hàm đọc dữ liệu từ file cache
    public function loadCache()
    {
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . $this->cacheFile)) {
            return json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . $this->cacheFile), true);
        }
        return false;
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
            "timestamp" => [
                "type" => "TIMESTAMP",
                "data_attribute" => "",
                "collate" => "",
                "default" => "CURRENT_TIMESTAMP",  // Hoặc có thể thay bằng null nếu muốn để mặc định là NULL
            ],
            "boolean" => [
                "type" => "BOOLEAN",
                "data_attribute" => "",
                "collate" => "",
                "default" => "",
            ],
            "tinyint" => [
                "type" => "TINYINT(1)",
                "data_attribute" => "",
                "collate" => "",
                "default" => $value_column_default,
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
    // tạo bảng
    public function createTable($tableName = null, $array_column = array())
    {
        $sql_table = "";
        $sql_table .= "CREATE TABLE " . $tableName . " (";
        $sql_table .= "id " . $this->type_id . ", ";
        if (!empty($array_column)) {
            foreach ($array_column as $column) {
                // lấy thông tin
                $info_column = $this->getParamColumn($column);
                $data_type_column = $this->getSQlTypeColumn($info_column->type);
                // kiểm tra
                if ($info_column->name == "id") {
                    var_dump("Cột id đã được tự động thêm không cần khai báo!");
                    die;
                }
                // sql
                $sql_table .= $info_column->name . " " .  $data_type_column->type . " " .  $data_type_column->data_attribute . " " .  $data_type_column->collate . " " .  $data_type_column->default;
                if (end($array_column) !== $column) {
                    $sql_table .= ", ";
                };
            }
            $sql_table .= ");";
            $this->rawQueryOne($sql_table, array());
        }
    }
    // kiểm tra bảng có tồn tại không
    public function checkTableExists($tableName = null)
    {
        $check_table = $this->rawQueryOne("SHOW TABLES LIKE '" . $tableName . "';", array());
        return !empty($check_table);
    }
    // lấy pram được khi báo
    public function getParamColumn($itemsColumn = null)
    {
        if ((stripos($itemsColumn, "|") !== false) && preg_match('/^[a-zA-Z0-9|_]+$/', $itemsColumn) === 1) {
            list($name, $type) = explode("|", $itemsColumn);
        } else {
            var_dump($itemsColumn . " không đúng định dạng!");
            var_dump("(Khai báo phải theo kiểu column|type không khoản cách không viết dấu)");
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
        $this->rawQueryOne("ALTER TABLE " . $nameTable . " MODIFY " . $name_column_key . " INT;", array());
        $this->rawQueryOne("ALTER TABLE " . $nameTable . " DROP PRIMARY KEY;", array());
    }
    // lấy các cột trong bảng
    public function getColumnTable($nameTable = null)
    {
        return $this->rawQuery("SHOW COLUMNS FROM " . $nameTable . "", array());
    }
    // lấy các khóa chính trong bảng
    public function getPrimariKeyTable($nameTable = null)
    {
        return $this->rawQueryOne("SHOW KEYS FROM " . $nameTable . " WHERE Key_name = 'PRIMARY'", array());
    }
    // kiểm tra dữ liệu có trong bảng chưa
    public function checkDataInTableSql($nameTable = null, $array_column = array(), $array_data = array())
    {
        if (!empty($array_data)) {
            $sql_table = "SELECT EXISTS (SELECT 1 FROM " . $nameTable . " WHERE ";
            foreach ($array_column as $key => $column) {
                if (!empty($array_data[$key])) {
                    if ($key != 0) {
                        $sql_table .= " AND ";
                    }
                    $sql_table .= " $column='" . $array_data[$key] . "' ";
                }
            }
            $sql_table .= ") AS exist;";
            $check = $this->rawQueryOne($sql_table, array());

            return !empty($check['exist']);
        } else {
            return false;
        }
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
    // ============================ end =============================

    // =================== Các hàm tổng =================
    // tạo và kiểm tra bảng
    public function autoCreateTable()
    {
        if (!empty($this->array_table)) {
            foreach ($this->array_table as $key_table => $value_table) {
                if (!empty($value_table) && !empty($key_table)) {
                    if (!$this->checkTableExists($key_table)) {
                        // Thêm bảng nếu bảng chưa tồn tại
                        $this->createTable($key_table, $value_table);
                    } else {
                        $array_name_column = [];
                        $array_type_column = [];
                        foreach ($value_table as $value_column) {
                            $info_column = $this->getParamColumn($value_column);
                            if ($info_column->name == "id") {
                                var_dump("Cột id đã được tự động thêm không cần khai báo!");
                                die;
                            }
                            $array_name_column[] = $info_column->name;
                            $array_type_column[$info_column->name] = $info_column->type;
                        }
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
                        $array_alter_table_column = [];
                        foreach ($table_show_column as $item) {
                            if (!in_array($item['Field'], $array_name_column)) {
                                $array_alter_table_column['handle'][] = "DROP COLUMN " . $item['Field'];
                            } else {
                                if ($item['Field'] == 'id') {
                                    $isInt = stripos($item['Type'], 'INT') !== false;
                                    $isAutoIncrement = stripos($item['Extra'], 'AUTO_INCREMENT') !== false;
                                    $isPrimaryKey = stripos($item['Key'], 'PRI') !== false;
                                    if (!$isInt || !$isAutoIncrement) {
                                        if (!$isPrimaryKey) {
                                            $array_alter_table_column['handle'][] = "DROP PRIMARY KEY";
                                        }
                                        $array_alter_table_column['handle'][] = "MODIFY " . $item['Field'] . $this->type_id;
                                    }
                                } else {
                                    if (stripos($item['Type'], $this->getSQlTypeColumn($array_type_column[$item['Field']])->type) === false) {
                                        $data_sql = $this->getSQlTypeColumn($array_type_column[$item['Field']]);
                                        $array_alter_table_column['handle'][] = "MODIFY " . $item['Field'] . " " . $data_sql->type . " " . $data_sql->data_attribute . " " . $data_sql->collate . " " . $data_sql->default;
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
                                if (!in_array($column, $resultArrayColumn)) {
                                    if ($column == 'id') {
                                        $array_alter_table_column['handle'][] = " ADD COLUMN id " . $this->type_id;
                                    } else {
                                        $data_sql = $this->getSQlTypeColumn($array_type_column[$column]);
                                        $array_alter_table_column['handle'][] = "ADD COLUMN " . $column . " " . $data_sql->type . " " . $data_sql->data_attribute . " " . $data_sql->collate . " " . $data_sql->default . " AFTER  id";
                                    }
                                    $resultArrayColumn[] = $column;
                                }
                            }
                        }
                        // Sắp Xếp các cột trong bảng
                        if ($array_name_column !== $resultArrayColumn) {
                            $before_column = "";
                            for ($i = 0; $i < $total_column_check; $i++) {
                                $location_array_search = array_search($array_name_column[$i], $resultArrayColumn);
                                if ($i == 0 && ($resultArrayColumn[$i] != 'id')) {
                                    // đổi vị trí đầu trong bảng
                                    $array_alter_table_column['sort'][] = "CHANGE id id  INT AUTO_INCREMENT FIRST";
                                    // đổi vị trí đầu trong chuổi kiểm tra
                                    $location_id_table = array_search('id', $resultArrayColumn);
                                    unset($resultArrayColumn[$location_id_table]);
                                    array_unshift($resultArrayColumn, 'id');
                                } else {
                                    if ($i != $location_array_search) {
                                        // đổi vị trí trong bảng
                                        $data_sql = $this->getSQlTypeColumn($array_type_column[$array_name_column[$i]]);
                                        $array_alter_table_column['sort'][] = "CHANGE " . $array_name_column[$i] . " " . $array_name_column[$i] . " " . $data_sql->type . " AFTER "  . $before_column;
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
                        // chạy sql
                        if (!empty($array_alter_table_column['handle'])) {
                            $this->rawQueryOne("ALTER TABLE " . $key_table . " " . implode(",", $array_alter_table_column['handle']) . ";", array());
                        }
                        if (!empty($array_alter_table_column['sort'])) {
                            $this->rawQueryOne("ALTER TABLE " . $key_table . " " . implode(",", $array_alter_table_column['sort']) . ";", array());
                        }
                    }
                } else {
                    var_dump("Có dữ liệu khai báo không hợp lệ");
                    die;
                }
            }
        }
    }
    // thêm dữ liệu vào bảng
    public function autoInsertTable()
    {
        if (!empty($this->array_insert_table)) {
            foreach ($this->array_insert_table as $key_table => $value_insert) {
                if (!$this->checkTableExists($key_table)) {
                    error_log("Bảng $key_table không tồn tại!");
                    continue;
                }

                if (empty($value_insert)) {
                    error_log("Dữ liệu truyền vào cho bảng $key_table đang rỗng!");
                    continue;
                }

                $value_insert = array_map('unserialize', array_unique(array_map('serialize', $value_insert)));

                $table_show_column = $this->getColumnTable($key_table);

                $array_name_column = [];
                $array_type_column = [];
                foreach ($table_show_column as $item) {
                    if ($item['Field'] != "id") {
                        $array_name_column[] = $item['Field'];
                        $array_type_column[] = $item['Type'];
                    }
                }

                $array_sql_value = [];
                foreach ($value_insert as $array_data) {
                    if (empty($array_data)) {
                        error_log("Bảng $key_table có trường dữ liệu bị rỗng!");
                        continue;
                    }
                    $check_data = $this->checkDataInTableSql($key_table, $array_name_column, $array_data);
                    if (!$check_data) {
                        // Kiểm tra kiểu dữ liệu
                        $this->checkTypeColumnTable($key_table, $array_type_column, $array_data);

                        // Chuẩn hóa số lượng cột
                        $array_data = array_pad($array_data, count($array_name_column), null);
                        $array_data = array_slice($array_data, 0, count($array_name_column));

                        // Chuyển giá trị thành chuỗi SQL
                        $array_data = array_map(function ($value_sql) {
                            return is_null($value_sql) ? 'NULL' : "'" . addslashes($value_sql) . "'";
                        }, $array_data);

                        $array_sql_value[] = "(" . implode(",", $array_data) . ")";
                    }
                }

                if (!empty($array_sql_value)) {
                    // Gộp các giá trị thành một câu lệnh duy nhất
                    $sql_table = "INSERT IGNORE INTO $key_table (" . implode(",", $array_name_column) . ") VALUES ";
                    $sql_table .= implode(",", $array_sql_value) . ";";

                    // Thực thi truy vấn
                    $this->rawQueryOne($sql_table, []);
                }
            }
        }
    }

    // đưa bảng về dữ liệu rỗng
    public function autoTruncateTable()
    {
        if (!empty($this->array_truncate_table)) {
            $tables_to_truncate = [];
            foreach ($this->array_truncate_table as $value_truncate) {
                if (!empty($value_truncate) && $this->checkTableExists($value_truncate)) {
                    $tables_to_truncate[] = $value_truncate;
                } else {
                    error_log("Bảng $value_truncate không tồn tại!");
                }
            }
            if (!empty($tables_to_truncate)) {
                $sql_table = implode("; ", array_map(fn($table) => "TRUNCATE TABLE $table", $tables_to_truncate)) . ";";
                $this->rawQueryOne($sql_table, []);
            }
        }
    }

    // ============================ end =============================

    // ===================== Hàm khởi động =================
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
    // Chuyển bảng thành dữ liệu rỗng
    public function setTruncateTableSql($arrayNameTable)
    {
        if (!empty($arrayNameTable)) {
            $this->array_truncate_table[] = $arrayNameTable;
        }
    }
    // auto xử lý 
    public function autoHandleTable()
    {
        $data_check = $this->loadCache();
        $data_handle = [];
        $data_handle[] = $this->array_table;
        $data_handle[] = $this->array_insert_table;
        $data_handle[] = $this->array_truncate_table;
        if (empty($data_check) || $data_check != $data_handle) {
            var_dump('ok');
            $this->connect();
            $this->autoCreateTable();
            $this->autoTruncateTable();
            $this->autoInsertTable();
            $this->close();
            $this->saveCache($data_handle);
        }


        // trả về dữ liệu rỗng sau khi xử lý
        $this->array_table = [];
        $this->array_insert_table = [];
        $this->array_truncate_table = [];
    }
    // ============================ end =============================
}
