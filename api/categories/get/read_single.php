<?php
	$category = new Category($db);
	// If it's not set, stop proc
	$id = isset($_GET['id']) ? $_GET['id'] : die();
	$category->getById($id);	

	// Verify there is a response to output
	if($category->category !== null && $category->id !== null){
		// Create array
		$output = array(
			'id' => $category->id,
			'category' => $category->category
		);

  // return JSON
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'categoryId Not Found')
		);
	}
?>