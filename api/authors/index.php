<?php 


	switch($_SERVER['REQUEST_METHOD']){
		case 'GET':
			include './get.php';
			break;
		default:
			'Something unexpected';
	}


?>