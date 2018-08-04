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
include 'etc/config.php';
include 'library.php';

//sleep(5);
$date = date('H:i:s');
//3/0;
dog("====================== New process begin at $date with: ");
dog($_REQUEST);
if ( isset($_REQUEST['action']) ) {
	include "action/" . $_REQUEST['action'] . '.php';
} else {
	error(-2, 'No input provided. Or maybe the file is too big.');
}
