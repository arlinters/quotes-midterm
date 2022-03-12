<?php

$category = new Category($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("id", $data)){
	$category->id = $data['id'];

	try{
		$category->delete();
		echo json_encode(
			['id'=>(int)$category->id]
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