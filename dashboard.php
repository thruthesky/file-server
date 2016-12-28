<?php

?>
<style>
    .temp.files img {
        max-width: 80px;
        max-height: 80px;
    }
</style>
<h1>Dashboard</h1>
<form enctype="multipart/form-data" action="index.php" method="POST">
    <input type="hidden" name="url_return" value="index.php">
    <input type="hidden" name="folder" value="jaeho">
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Upload File" />
</form>

<hr>
Files uploaded in 'temp' folder
<hr>
<div class="temp files">
<?php
foreach (glob("data/temp/*") as $filename) {
    // echo "$filename size " . filesize($filename) . "<br>";
    echo "<img src='$filename'>";
}
?>
</div>
