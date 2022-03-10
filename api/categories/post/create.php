<?php

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("category", $data)){
	$category->category = $data['category'];
	try{
		$category->create();
		echo json_encode(
			['id'=>$category->id, 'category' => $category->category]
		);
	}
	catch(Exception $e){
		// set generic 500 error
		http_response_code(500);
		echo json_encode(
			['message' => 'Something went wrong when trying to insert this category into the database.']
		);
	}
}
else{
	echo json_encode(
		array('message' => 'Missing Required Parameters')
	);
}



?>
