<?php

$author = new Author($db);
// Get Data from request
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("author", $data)){
	// bind the author to the property
	$author->author = $data['author'];
	try{
		$author->create();
		echo json_encode(
			['id'=>(int)$author->id, 'author' => $author->author]
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
