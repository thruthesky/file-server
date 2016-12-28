<?php
$files = [];
foreach (glob("data/$_REQUEST[folder]/*") as $filename) {
    $files[] = $filename;
}
echo json_encode( $files );
