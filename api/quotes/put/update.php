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
	try{
		$quote->update($data['authorId'],$data['categoryId']);
		echo json_encode(
			[
				'id'=>(int)$quote->id,
				'quote' => $quote->quote,
				'categoryId' => (int)$quote->category->id,
				'authorId' => (int)$quote->author->id
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