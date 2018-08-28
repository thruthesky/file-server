<?php
//$filename = basename($_FILES['userfile']['name']);
//$filename = get_safe_name( $filename );
$file = $_FILES['userfile'];
$filename = get_upload_filename( $file, $_REQUEST['uid'], $_REQUEST['secret'] );
$uploadfile = $uploaddir . '/' . $filename;

//dog($_FILES);
if ( isset($_FILES['userfile']['error']) && $_FILES['userfile']['error'] ) return error( $_FILES['userfile']['error'] * -1, codeToMessage($_FILES['userfile']['error']));

if ( ! isTest() ) {
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {

	} else {
		$reason = "Possible file upload attack!";
		return error(-130, $reason);
	}
}

$re = [ 'name' => $file['name'], 'type' => $file['type'], 'size' => $file['size'], 'path' => $uploadfile ];

//dog("DI? -----");

//$re = saveFileInfo($uploadfile, $_FILES['userfile']);
//if ( ! $re ) {
//	return error(-120, "Failed to save file information.");
//}


success( $re );
return;




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
