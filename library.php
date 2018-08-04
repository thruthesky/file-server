<?php
function enableTest() {
	global $_TEST;
	$_TEST = true;
}
function disableTest() {
	global $_TEST;
	$_TEST = false;
}
function isTest() {
	global $_TEST;
	if ( ! isset($_TEST) ) return false;
	return $_TEST;
}

function dog($data) {
	error_log( var_export($data, TRUE) . "\n", 3, "data/debug.log");
}

/**
 * @param $code
 * @param $message
 *
 * @return int
 */
function error($code, $message) {
	echo json_encode(['code' => $code, 'message' => $message]);
	return 0;
}

function success($data) {
	echo json_encode(['code' => 0, 'data' => $data]);
}
function get_safe_name($filename, $uid = '0', $secret = '') {
	global $server_secret;

	$pi = pathinfo($filename);

	if ( isset($pi['extension']) ) {
		$ext = strtolower($pi['extension']);
	}
	else {
		$ext = '';
	}

	return md5($filename) . '-' . md5("$uid,$secret,$server_secret") . '.' . $ext;
}

function saveFileInfo($filename, $info) {
	$path = "$filename.info";
	$up = [ 'name' => $info['name'], 'type' => $info['type'], 'size' => $info['size'], 'path' => $filename ];
	$str = serialize($up);
	$re = file_put_contents( $path, $str );
	if ( ! $re ) return false;
	return $up;
}

function codeToMessage($code)
{
	switch ($code) {
		case UPLOAD_ERR_INI_SIZE:
			$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
			break;
		case UPLOAD_ERR_PARTIAL:
			$message = "The uploaded file was only partially uploaded";
			break;
		case UPLOAD_ERR_NO_FILE:
			$message = "No file was uploaded";
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$message = "Missing a temporary folder";
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$message = "Failed to write file to disk";
			break;
		case UPLOAD_ERR_EXTENSION:
			$message = "File upload stopped by extension";
			break;

		default:
			$message = "Unknown upload error";
			break;
	}
	return $message;
}
