<?php

$_url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$_arr = explode("index.php", $_url);
$url_file_server = $_arr[0];

$files = [];
foreach (glob("data/$_REQUEST[folder]/*") as $filename) {
    $files[] = "$url_file_server/$filename";
}
echo json_encode( $files );
