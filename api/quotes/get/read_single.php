<?php
	$quote = new Quote($db);
	$id = isset($_GET['id']) ? $_GET['id'] : die();
	$quote->getById($id);	

	if($quote->quote !== null && $quote->id !== null){
		// Create array
		$output = array(
			'id' => $quote->id,
			'quote' => $quote->quote
		);

  // Make JSON
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'No quote Found')
		);
	}
?>