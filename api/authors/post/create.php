<?php

$author = new Author($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("author", $data)){
	$author->author = $data['author'];
	try{
		$author->create();
		echo json_encode(
			['id'=>$author->id, 'author' => $author->author]
		);
	}
	catch(Exception $e){
		// set generic 500 error
		http_response_code(500);
		echo json_encode(
			['message' => 'Something went wrong when trying to insert this author into the database.']
		);
	}
}
else{
	echo json_encode(
		array('message' => 'Missing Required Parameters')
	);
}



?>
