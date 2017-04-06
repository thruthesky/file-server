<?php


/**
 * --------------------- EDIT ---------------------------
 */
$_url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$_arr = explode("index.php", $_url);
$url_file_server = $_arr[0];


//error_log( var_export($_FILES, TRUE), 3, "./debug.log");

if ( isset($_FILES["file"]) ) $file = $_FILES["file"];
else {


	echo json_encode( [
	    'error' => -404,
	    'message' => "file not uploaded",
	] );
exit;
}
$error = '';
$url = '';


// Sanitize filename.
$filename = $file["name"];
$pi = pathinfo($filename);

$first_md5 = md5($filename . time() . $_SERVER['REMOTE_ADDR']);

if ( isset($pi['extension']) ) {
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
    $e = error_get_last();
    $error = "$e[message] at $e[line] on $e[file]";
}
else {
    $url = "$url_file_server$path_upload";
}
if ( empty($error) && isset($_REQUEST['url_return']) ) {
    echo "
        <script>
            location.href='$_REQUEST[url_return]';
        </script>
    ";
    exit;
}

echo json_encode( [
    'error' => $error,
    'url' => $url,
    'filename' => $filename
] );
