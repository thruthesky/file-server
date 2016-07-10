<?php
/**
 * @file index.php
 *
 *
 */

$file = $_FILES["userfile"];
print_r($file);

// Sanitize filename.
$filename = $file["name"];
$pi = pathinfo($filename);

if ( $pi['extension'] ) {
    $ext = strtolower($pi['extension']);
}
else $ext = '';

$str = $filename . time() . $_SERVER['REMOTE_ADDR'];
$name = md5( $str );

$path_upload = "data/upload/wp/$name.$ext";

if ( $file['error'] ) die($file['error']);
if ( ! move_uploaded_file( $file['tmp_name'], $path_upload ) ) die( "Failed on moving uploaded file." );
?>
<script>
    var data = {};
    data.url = "http://work.org/file-upload/<?php echo $path_upload?>";
    data.filename = "<?php echo $filename?>";
    parent.postMessage(data, "*");
</script>
