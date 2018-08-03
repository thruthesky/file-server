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
foreach (glob("data/temp/*") as $filename) {
    // echo "$filename size " . filesize($filename) . "<br>";
    echo "<img src='$filename'>";
}
?>
</div>
