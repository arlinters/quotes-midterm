<?php

	$author = new Author($db);
	// If the ID is not found, stop processing
	$id = isset($_GET['id']) ? $_GET['id'] : die();
	// pass ID into function to fetch ID and associate response
	$author->getById($id);	


	// If the object was found then:
	if($author->author !== null && $author->id !== null){
			
		// Create array
		$output = array(
			'id' => $author->id,
			'author' => $author->author
		);

  // echo JSON response
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'authorId Not Found')
		);
	}
?>