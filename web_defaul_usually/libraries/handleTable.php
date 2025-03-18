<?php

class handleTable
{

    private $_db;
    private $array_table = [];
    private $array_insert_table = [];
    private $array_truncate_table = [];
    private $array_foreignKey_table = [];

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
    // kết nối
    public function connect()
    {
        if ($this->_db === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
                $this->_db = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT => true,
                ]);
            } catch (PDOException $e) {
                throw new RuntimeException("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
            }
        }
        return $this->_db;
    }
    // đóng kết nối
    public function close()
    {
        $this->_db = null;
    }
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
    // Thêm Dữ liệu vào bảng
    public function setTruncateTableSql($arrayNameTable)
    {
        if (!empty($arrayNameTable)) {
            $this->array_truncate_table[] = $arrayNameTable;
        }
    }
    // Thêm Khóa ngoại cho bảng
    public function setForeignKeyTableSql($arrayInfoSql = [])
    {
        if (!empty($arrayInfoSql)) {
            $array_Info_Detail = [
                "master_table" => "",
                "master_id" => "",
                "child_table" => "",
                "child_id" => "",
                "constraint" => "",
                "update" => true,
                "delete" => true,
            ];
            $arrayInfoSql = array_merge($array_Info_Detail, $arrayInfoSql);
            $this->array_foreignKey_table[] = $arrayInfoSql;
        }
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
        foreach ($array_column as $column) {
            $type = $this->getParamColumn($column)->type;
            $sql_table .= $this->getParamColumn($column)->name . " " . $this->getSQlTypeColumn($type)->type . " " . $this->getSQlTypeColumn($type)->data_attribute . " " . $this->getSQlTypeColumn($type)->collate . " " . $this->getSQlTypeColumn($type)->default;
            if (end($array_column) !== $column) {
                $sql_table .= ", ";
            };
        }
        $sql_table .= ");";
        $this->rawQueryOne($sql_table, array());
    }
    // kiểm tra cột trong bảng có tồn tại không 
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
        $stmt = $this->rawQueryOne($query);

        // Kiểm tra kết quả trả về
        return !empty($stmt);
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
        $sql_table = "SELECT COUNT(*) AS TOTAL FROM " . $nameTable . " WHERE ";
        foreach ($array_column as $key => $column) {
            if (!empty($array_data[$key])) {
                if ($key != 0) {
                    $sql_table .= " AND ";
                }
                $sql_table .= " $column='" . $array_data[$key] . "' ";
            }
        }
        $check = $this->rawQueryOne($sql_table, array());
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
                if (in_array("id", $value_table)) {
                    var_dump("Cột id đã được tự động thêm không cần khai báo!");
                    die;
                }
                if (!$this->checkTableExists($key_table)) {
                    // Thêm bảng nếu bảng chưa tồn tại
                    $this->createTable($key_table, $value_table);
                } else {
                    $array_name_column = [];
                    $array_type_column = [];
                    foreach ($value_table as $value_column) {
                        $array_name_column[] = $this->getParamColumn($value_column)->name;
                        $array_type_column[$this->getParamColumn($value_column)->name] = $this->getParamColumn($value_column)->type;
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
                    foreach ($table_show_column as $item) {
                        if (!in_array($item['Field'], $array_name_column)) {
                            $this->rawQueryOne("ALTER TABLE " . $key_table . " DROP COLUMN " . $item['Field'] . ";", array());
                        } else {
                            if ($item['Field'] == 'id') {
                                $isInt = stripos($item['Type'], 'INT') !== false;
                                $isAutoIncrement = stripos($item['Extra'], 'AUTO_INCREMENT') !== false;
                                $isPrimaryKey = stripos($item['Key'], 'PRI') !== false;
                                if (!$isInt || !$isAutoIncrement) {
                                    if (!$isPrimaryKey) {
                                        $this->rawQueryOne("ALTER TABLE " . $key_table . " DROP PRIMARY KEY;", array());
                                    }
                                    $this->rawQueryOne("ALTER TABLE " . $key_table . " MODIFY " . $item['Field'] . $this->type_id . " ;", array());
                                }
                            } else {
                                if (stripos($item['Type'], $this->getSQlTypeColumn($array_type_column[$item['Field']])->type) === false) {
                                    $this->rawQueryOne("ALTER TABLE " . $key_table . " MODIFY " . $item['Field'] . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->type . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->data_attribute . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->collate . " " . $this->getSQlTypeColumn($array_type_column[$item['Field']])->default . ";", array());
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
                                $this->rawQueryOne($sql_add_column_detail, array());
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
                                $this->rawQueryOne($sql_table_detail, array());
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
                                    $this->rawQueryOne($sql_table_detail, array());
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
                $array_sql_value = [];
                if ($this->checkTableExists($key_table) && !empty($value_insert)) {
                    $value_insert = array_unique(array_map('serialize', $value_insert));
                    $value_insert = array_map('unserialize', $value_insert);
                    $table_show_column = $this->getColumnTable($key_table);
                    $array_name_column = [];
                    $array_type_column = [];
                    foreach ($table_show_column as $item) {
                        if ($item['Field'] != "id") {
                            $array_name_column[] = $item['Field'];
                            $array_type_column[] = $item['Type'];
                        }
                    }
                    $sql_table .= "INSERT INTO $key_table (" . implode(",", $array_name_column) . ") VALUES ";
                    foreach ($value_insert as $key_data => $array_data) {
                        if (!empty($array_data)) {
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
                                if (!empty($array_data)) {
                                    foreach ($array_data as $key_sql => $value_sql) {
                                        if (is_null($value_sql)) {
                                            $array_data[$key_sql] = 'NULL';
                                        } elseif (!empty($value_sql)) {
                                            $array_data[$key_sql] = "'" . $value_sql . "'";  // Nếu không phải NULL, thêm dấu nháy đơn
                                        }
                                    }
                                }
                                $array_sql_value[] = "(" . implode(",", $array_data) . ")";
                            }
                        } else {
                            var_dump("Bảng $key_table có trường dữ liệu bị rổng!");
                            die;
                        }
                    }
                    if (!empty($array_sql_value)) {
                        $sql_table .= implode(",", $array_sql_value);
                        $sql_table .= ";";
                        $this->rawQueryOne($sql_table, array());
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
    // đưa bảng về dữ liệu rỗng
    public function autoTruncateTable()
    {
        if (!empty($this->array_truncate_table)) {
            foreach ($this->array_truncate_table as $key_truncate => $value_truncate) {
                $sql_table = "";
                if (!empty($value_truncate) && $this->checkTableExists($value_truncate)) {
                    $sql_table .= "TRUNCATE TABLE $value_truncate;";
                    $this->rawQueryOne($sql_table, array());
                } else {
                    var_dump("Bảng $value_truncate không tồn tại!");
                    die;
                }
            }
        }
    }
    // thêm khóa ngoại vào bảng
    public function autoForeignKeyTable()
    {
        if (!empty($this->array_foreignKey_table)) {
            foreach ($this->array_foreignKey_table as $key_foreignKey => $value_foreignKey) {
                $sql_table = "";
                if (!empty($value_foreignKey)) {
                    if ($this->checkTableExists($value_foreignKey['']) == false) {
                    }
                    if ($this->checkTableExists($value_foreignKey['']) == false) {
                    }
                    if ($this->checkColumnExists() == false) {
                    }
                    if ($this->checkColumnExists() == false) {
                    }
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
        $this->connect();
        $this->autoCreateTable();
        $this->autoTruncateTable();
        $this->autoInsertTable();
        $this->close();

        // trả về dữ liệu rỗng sau khi xử lý
        $this->array_table = [];
        $this->array_insert_table = [];
        $this->array_truncate_table = [];
        $this->array_foreignKey_table = [];
    }
}
