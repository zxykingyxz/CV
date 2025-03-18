<?php

$folder_global = _LIB . "GLOBAL";

if (is_dir($folder_global) && is_readable($folder_global)) {
    $files = scandir($folder_global);
    foreach ($files as $file) {
        if (file_exists($folder_global . '/' . $file) && !in_array($file, ['.', '..'])) {
            include_once $folder_global . '/' . $file;
        }
    }
}
