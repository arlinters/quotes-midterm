<?php 
include_once '../../includes/api_headers.php';
include_once '../../includes/db_connect.php';
include_once '../../models/Author.php';
include_once('../../includes/get_relative_path.php');

// Route to the correct file based on the request method.
	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			include getRelativeFile(__FILE__, 'get/index.php');
			break;
		case 'DELETE':
			include getRelativeFile(__FILE__, 'delete/remove.php');
			break;
		case 'POST':
			include getRelativeFile(__FILE__, 'post/create.php');
			break;
		case 'PUT':
			include getRelativeFile(__FILE__, 'put/update.php');
			break;
		default:
			'Something unexpected';
	}


?>