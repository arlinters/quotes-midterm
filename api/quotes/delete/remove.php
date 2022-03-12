<?php

$quote = new Quote($db);
$data = json_decode(file_get_contents("php://input"), true);

if(array_key_exists("id", $data)){
	$quote->id = $data['id'];

	try{
		$quote->delete();
		echo json_encode(
			['id'=>(int)$quote->id]
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