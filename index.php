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

if ( isset($_REQUEST['action']) ) {
	include "action/" . $_REQUEST['action'] . '.php';
} else {
	error(-2, 'No action provided');
}
