<?php

$category = new Category($db);
// Get request data
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("id", $data)){
	$category->id = $data['id'];

	try{
		$category->delete();
		// return resposne from delete
		echo json_encode(
			['id'=>(int)$category->id]
		);
	}
	catch(Exception $e){
		// return error message
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