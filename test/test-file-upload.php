<?php
$_SERVER['REQUEST_METHOD'] = 'POST';
$_REQUEST['action'] = 'file-upload';
$_FILES['userfile']['name'] = 'abc.jpg';
$_FILES['userfile']['tmp_name'] = 'tmp_abc.jpg';
$_FILES['userfile']['type'] = 'image/jpg';
$_FILES['userfile']['size'] = '12345';
$_TEST = true;

ob_start();
include 'index.php';
$re = ob_get_clean();


$info = json_decode($re, true);

echo ">>>>>> Result of file upload:\n";
print_r($info);

if ( $info['code'] != 0 ) echo "ERROR: $info[code] $info[message]\n";
$data = $info['data'];
if ( preg_match("/\.jpg$/", $data['path']) ) {
	echo "OK: path end with .jpg\n";
} else {
	echo "ERROR: path does not end with .jpg\n";
}

$content = file_get_contents( $data['path'] . ".info" );
$saved = unserialize($content);
if ( $_FILES['userfile']['name'] == $data['name'] && $data['name'] == $saved['name'] ) echo "OK. file name match!\n";
else echo "ERROR FILENAME DOES NOT MATCH\n";

if ( $_FILES['userfile']['size'] == $data['size'] && $data['size'] == $saved['size'] ) echo "OK. file size match!\n";
else echo "ERROR FILE SIZE DOES NOT MATCH\n";

if ( $_FILES['userfile']['type'] == $data['type'] && $data['type'] == $saved['type'] ) echo "OK. file type match!\n";
else echo "ERROR FILE TYPE DOES NOT MATCH\n";



for( $i = 1; $i <= 8; $i ++ ) {

	$_FILES['userfile']['error'] = $i;
	ob_start();
	include 'action/file-upload.php';
	$json = ob_get_clean();
	$re = json_decode($json, true);

	if ( $re['code'] == ($i * -1) ) echo "OK: Error test with ". codeToMessage($i) ."\n";
	else echo "ERROR: file init size error\n";
}
