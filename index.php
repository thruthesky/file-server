<?php
/**
 * @file index.php
 *
 * @desc This index.php is very simple. It does file upload/delete based on the input.
 * @see README.md
 *
 */

// --------------------- DON'T EDIT THIS FILE ---------------------

include 'etc/preflight.php';

if ( isset($_FILES) && count($_FILES) ) include "file-upload.php";
else if ( isset( $_REQUEST['action'] ) ) include $_REQUEST['action'] . '.php';
else include "dashboard.php";


