<?php
	$category = new Category($db);
	$id = isset($_GET['id']) ? $_GET['id'] : die();
	$category->getById($id);	

	if($category->category !== null && $category->id !== null){
	
		// Create array
		$output = array(
			'id' => $category->id,
			'category' => $category->category
		);

  // Make JSON
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'No category Found')
		);
	}
?>