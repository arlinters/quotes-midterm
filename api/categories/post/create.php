<?php

$category = new Category($db);
// Get request data
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("category", $data)){
	$category->category = $data['category'];
	try{
		$category->create();
		// Output response
		echo json_encode(
			['id'=>(int)$category->id, 'category' => $category->category]
		);
	}
	catch(Exception $e){
		echo json_encode(
			['message' => $e->getMessage()]
		);
	}
}
else{
	echo json_encode(
		array('message' => 'Missing Required Parameters')
	);
}



?>
