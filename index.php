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
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET,POST");



if ( isset($_FILES["userfile"]) ) include "file-upload.php";
else if ( isset( $_REQUEST['action'] ) ) include $_REQUEST['action'] . '.php';
else include "dashboard.php";


