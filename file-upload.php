<?php

$file = $_FILES["userfile"];



// Sanitize filename.
$filename = $file["name"];
$pi = pathinfo($filename);

$first_md5 = md5($filename . time() . $_SERVER['REMOTE_ADDR']);

if ( $pi['extension'] ) {
    $ext = strtolower($pi['extension']);
}
else $ext = '';

$str = $filename . time() . $_SERVER['REMOTE_ADDR'];
$name = md5( $str );

if ( isset($_REQUEST['folder']) ) $dir = "data/$_REQUEST[folder]";
else $dir = "data/temp";
if ( ! is_dir( $dir) ) @mkdir( $dir, 0777, true );


$path_upload = "$dir/{$first_md5}.$ext";

if ( $file['error'] ) die($file['error']);
if ( ! @move_uploaded_file( $file['tmp_name'], $path_upload ) ) {
    $url = "";
    $e = error_get_last();
    $error = "$e[message] at $e[line] on $e[file]";
}
else {
    $error = '';
    $url = "$url_file_server$path_upload";
}
if ( isset($_REQUEST['url_return']) ) {
    echo "
        <script>
            location.href='$_REQUEST[url_return]';
        </script>
    ";
}
else {
    echo json_encode( [
        'error' => $error,
        'url' => $url,
        'filename' => $filename
    ] );
}
function error($code, $message) {
    die( json_encode( [ 'code'=>$code, 'message'=>$message]));
}
