<?php

$author = new Author($db);
// Fetch data
$data = json_decode(file_get_contents("php://input"), true);

// Get the id from the submitted data and try to delete the item
if(array_key_exists("id", $data)){
	// Associate the id with the author object
	$author->id = $data['id'];
	try{
		$author->delete();
		// echo the output
		echo json_encode(
			['id'=>(int)$author->id]
		);
	}
	catch(Exception $e){
		// Echo the error message the raised exception in $author->delete()
		echo json_encode(
			['message' => $e->getMessage()]
		);
	}
}
else{
	// The ID was not found in the request
	echo json_encode(
		array('message' => 'Missing Required Parameters')
	);
}

?>