<?php

$url = $_REQUEST['url'];
$_arr = explode( "/data/", $url);

$path_file_to_delete = "./data/$_arr[1]";

$re = @unlink( $path_file_to_delete );

if ( $re ) echo json_encode(['error'=>'']);
else echo json_encode(['error'=>'failed to delete file']);
