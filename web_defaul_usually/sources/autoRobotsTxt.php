<?php
/* Array robots */
$array_bot = [
    'User-agent: *',
    'Disallow: /cgi-bin/',
    'Disallow: /i-web/',
    'Disallow: /tim-kiem?',
    'Disallow: *page=*',
    'Disallow: /account?',
    'Disallow: /carts?',
    'Sitemap: ' . $https_config . 'sitemap.xml'
];
$bot_name = 'robots.txt';
if (!file_exists($bot_name)) {
    touch($bot_name);
}
if (file_exists($bot_name)) {
    $fileName = fopen($bot_name, "w") or die("Unable to open file");
    foreach ($array_bot as $content) {
        fwrite($fileName, $content . "\r");
    }
    fclose($fileName);
}
