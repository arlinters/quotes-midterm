<?php 
include_once '../../includes/api_headers.php';
include_once '../../includes/db_connect.php';
include_once '../../models/Category.php';
// For getting relative paths in the nested includes.
include_once '../../includes/get_relative_path.php';

	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			include getRelativeFile(__FILE__, 'get/index.php');
			break;
		case 'POST':
			include getRelativeFile(__FILE__, 'post/create.php');
			break;
		default:
			'Something unexpected';
	}

?>