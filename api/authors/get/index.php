<?php 
// File routing for single and multiple response
	if(isset($_GET['id'])){
		include getRelativeFile(__FILE__, 'read_single.php');
	}else{
		include getRelativeFile(__FILE__, 'read.php');
	}


?>