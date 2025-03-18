<?php

$config['website'] = array(
    'server-name' => $_SERVER['SERVER_NAME'],
    'url' => '/',
    'debug-css' => false,
    'debug-js' => false,
    'debug-developer' => true,
    'debug-responsive' => true,
    'error-reporting' => false,
    'search' => 3,
    'page' => 30,
    'author' => "Nguyễn Nhật Quang",
);
$config['database'] = array(
    'type' => 'mysql',
    'host' => 'localhost',
    'port' => 3306,
    'prefix' => 'table_',
    'charset' => 'utf8mb4'
);

$config['database']['dbname'] = "1db_zxykingyxz";
$config['database']['username'] = "root";
$config['database']['password'] = "";

// thông báo
$config['notification'] = array(
    'day_before_holiday' => 20,
);

// dữ liệu
$config['data'] = [
    "chi-tieu" => [
        [
            "title" => "Chi tiêu ăn uống",
            "value" => 1,
        ],
        [
            "title" => "Chi tiêu mua sắm",
            "value" => 2,
        ],
        [
            "title" => "Chi tiêu sinh hoạt",
            "value" => 3,
        ],
        [
            "title" => "Chi tiêu gia đình",
            "value" => 4,
        ],
        [
            "title" => "Chi tiêu tài chính",
            "value" => 5,
        ],
        [
            "title" => "Chi tiêu kinh doanh",
            "value" => 6,
        ],
        [
            "title" => "Chi tiêu sức khỏe",
            "value" => 7,
        ],
        [
            "title" => "Chi tiêu bảo dưỡng",
            "value" => 8,
        ],
        [
            "title" => "Chi tiêu khác",
            "value" => 99,
        ],
    ],
    "thu-nhap" => [
        [
            "title" => "Thu nhập chính",
            "value" => 1,
        ],
        [
            "title" => "Thu nhập phụ",
            "value" => 2,
        ],
        [
            "title" => "Thu nhập đầu tư",
            "value" => 3,
        ],
        [
            "title" => "Thu nhập thụ động",
            "value" => 4,
        ],
        [
            "title" => "Thu nhập khác",
            "value" => 99,
        ],
    ]
];
$config['data']['month'] = [
    [
        "title" => "Tháng 1",
        "value" => "01"
    ],
    [
        "title" => "Tháng 2",
        "value" => "02"
    ],
    [
        "title" => "Tháng 3",
        "value" => "03"
    ],
    [
        "title" => "Tháng 4",
        "value" => "04"
    ],
    [
        "title" => "Tháng 5",
        "value" => "05"
    ],
    [
        "title" => "Tháng 6",
        "value" => "06"
    ],
    [
        "title" => "Tháng 7",
        "value" => "07"
    ],
    [
        "title" => "Tháng 8",
        "value" => "08"
    ],
    [
        "title" => "Tháng 9",
        "value" => "09"
    ],
    [
        "title" => "Tháng 10",
        "value" => "10"
    ],
    [
        "title" => "Tháng 11",
        "value" => "11"
    ],
    [
        "title" => "Tháng 12",
        "value" => "12"
    ],
];

$config['data']['year'] = [];
for ($y = date('Y'); $y >= 2000; $y--) {
    array_push($config['data']['year'], [
        "title" => "Năm " . $y,
        "value" => $y
    ]);
}

error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

$http = 'http';
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $http .= "s";
} else if (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == "1")) {
    $http .= "s";
}
$config_url = $config['website']['server-name'] . $config['website']['url'];
$https_config = $http . $config_url;
