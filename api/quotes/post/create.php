<?php

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"), true);

// Require all properties in order to POST
if(
	array_key_exists("quote", $data) &&
	array_key_exists("authorId", $data) &&
	array_key_exists("categoryId", $data)
){
	$quote->quote = $data['quote'];

	try{
		$quote->create($data['authorId'], $data['categoryId']);
		echo json_encode(
			[
				'id'=>(int)$quote->id,
				'quote' => $quote->quote,
				'authorId' => (int)$quote->author->id,
				'categoryId' => (int)$quote->category->id
			]
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
