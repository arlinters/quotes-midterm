<?php

$author = new Author($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("author", $data) && array_key_exists("id", $data)){
	$author->author = $data['author'];
	$author->id = $data['id'];

	try{
		$author->update();
		echo json_encode(
			['id'=>$author->id, 'author' => $author->author]
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