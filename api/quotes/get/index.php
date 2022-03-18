<?php 

	// If ID is set, search for specific item
	if(isset($_GET['id'])){
		include getRelativeFile(__FILE__, 'read_single.php');
	}else{
		include getRelativeFile(__FILE__, 'read.php');
	}
?>