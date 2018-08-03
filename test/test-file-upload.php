<?php

$_SERVER['REQUEST_METHOD'] = 'POST';
$_REQUEST['action'] = 'file-upload';
$_FILES['userfile']['name'] = 'abc.jpg';
$_FILES['userfile']['tmp_name'] = 'tmp_abc.jpg';
$_FILES['userfile']['type'] = 'image/jpg';
$_FILES['userfile']['size'] = '12345';
include '../index.php';
