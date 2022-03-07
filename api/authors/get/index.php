<?php 
	if(isset($_GET['id'])){
		include getRelativeFile(__FILE__, 'getOne.php');
	}else{
		include getRelativeFile(__FILE__, 'getMultiple.php');
	}


?>