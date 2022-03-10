<?php 

	// If ID is set, search for specific item
	if(isset($_GET['id']) || isset($_GET['authorId']) || isset($_GET['categoryId'])){
		include getRelativeFile(__FILE__, 'read_single.php');
	}else{
		include getRelativeFile(__FILE__, 'read.php');
	}
?>