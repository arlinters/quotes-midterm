<?php 

// Route based on type of read. Single items will have id on the request query param
	if(isset($_GET['id'])){
		include getRelativeFile(__FILE__, 'read_single.php');
	}else{
		include getRelativeFile(__FILE__, 'read.php');
	}
?>