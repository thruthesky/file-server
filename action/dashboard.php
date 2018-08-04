<?php

?>
<style>
    .temp.files img {
        max-width: 80px;
        max-height: 80px;
    }
</style>
<h1>Dashboard</h1>
<hr>
Files uploaded in 'temp' folder
<hr>
<div class="temp files">
<?php
$uploadfile = $uploaddir;
foreach (glob("$uploadfile/*") as $filename) {
    // echo "$filename size " . filesize($filename) . "<br>";
    if ( preg_match("/\.info$/", $filename) ) {
        // file info.
    } else {
	    echo "<img src='$filename'>";
    }
}
?>
</div>
