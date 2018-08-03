<?php


function error($code, $message) {
	echo json_encode(['code' => $code, 'message' => $message]);
	exit;
}
function success($data) {
	echo json_encode(['code' => 0, 'data' => $data]);
	exit;
}
function get_safe_name($filename, $uid = '0', $secret = '') {
	global $server_secret;
	return md5($filename) . '-' . md5("$uid,$secret,$server_secret");
}

function saveFileInfo($path, $info) {
	$path .= ".info";
	$up = [ 'name' => $info['name'], 'type' => $info['type'], 'size' => $info['size'] ];
	$str = serialize($up);
	return file_put_contents( $path, $str );
}
