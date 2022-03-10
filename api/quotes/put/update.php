<?php

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"), true);

if(
	array_key_exists("quote", $data) &&
	array_key_exists("id", $data) &&
	array_key_exists("authorId", $data) &&
	array_key_exists("categoryId", $data)
){
	$quote->quote = $data['quote'];
	$quote->id = $data['id'];
	$quote->authorId = $data['authorId'];
	$quote->categoryId = $data['categoryId'];

	try{
		$quote->update();
		echo json_encode(
			[
				'id'=>$quote->id,
				'quote' => $quote->quote,
				'categoryId' => $quote->categoryId,
				'authorId' => $quote->authorId
				]
		);
	}
	catch(Exception $e){
		// set generic 500 error
		http_response_code(500);
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