<?php

	$author = new Author($db);
	$id = isset($_GET['id']) ? $_GET['id'] : die();
	$author->getById($id);	


	if($author->author !== null && $author->id !== null){
			
		// Create array
		$output = array(
			'id' => $author->id,
			'author' => $author->author
		);

  // Make JSON
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>