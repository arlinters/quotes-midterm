<?php 
include_once('../../includes/get_relative_path.php');

	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			include getRelativeFile(__FILE__, 'get/index.php');
			break;
		default:
			'Something unexpected';
	}


?>