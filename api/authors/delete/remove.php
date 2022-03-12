<?php

$author = new Author($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("id", $data)){
	$author->id = $data['id'];

	try{
		$author->delete();
		echo json_encode(
			['id'=>(int)$author->id]
		);
	}
	catch(Exception $e){
		// set generic 500 error
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