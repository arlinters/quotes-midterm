<?php
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, quoteization, X-Requested-With');

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"), true);


if(
	array_key_exists("quote", $data) &&
	array_key_exists("authorId", $data) &&
	array_key_exists("categoryId", $data)
){
	$quote->quote = $data['quote'];
	$quote->authorId = $data['authorId'];
	$quote->categoryId = $data['categoryId'];

	try{
		$quote->create();
		echo json_encode(
			[
				'id'=>$quote->id,
				'quote' => $quote->quote,
				'authorId' => $quote->authorId,
				'categoryId' => $quote->categoryId
			]
		);
	}
	catch(Exception $e){
		// set generic 500 error
		http_response_code(500);
		echo json_encode(
			['error' => $e->getMessage()]
		);
	}
}
else{
	echo json_encode(
		array('message' => 'Missing Required Parameters')
	);
}



?>
