<?php
/**
 * @file index.php
 *
 * @desc This index.php is very simple. It does file upload/delete based on the input.
 * @see README.md
 *
 */
/**
 * --------------------- EDIT ---------------------------
 */
$url_file_server = "http://".$_SERVER['HTTP_HOST']."/file-upload/";
$file_server_secret_key = 'Change it with any sting as you wish. But once it is set, it should be changed. thruthesky';
// --------------------- DON'T EDIT ---------------------

$second_md5 = md5("$file_server_secret_key$_REQUEST[domain]$_REQUEST[uid]");


$file = $_FILES["userfile"];
//print_r($file);

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

$sub_folder = substr($first_md5, 0,  1);
$path_middle = "data/upload/$_REQUEST[domain]/$sub_folder/";
if ( ! is_dir( $path_middle) ) {
    @mkdir( $path_middle, 0777, true );
}

$path_upload = "data/upload/$_REQUEST[domain]/$sub_folder/{$first_md5}_$second_md5.$ext";

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



?>
<script>
    var data = {};
	data.error = "<?php echo $error?>";
    data.url = "<?php echo $url?>";
    data.filename = "<?php echo $filename?>";
    parent.postMessage(data, "*");
</script>
