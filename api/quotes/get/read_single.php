<?php
	$quote = new Quote($db);
	if(isset($_GET['id'])){
		$quote->id = $_GET['id'];
	}

	$quote->getByQuoteId();	

	if($quote->quote !== null && $quote->id !== null){
		// Create array
		$output = array(
			'id' => $quote->id,
			'quote' => $quote->quote,			
			'author' => $quote->author->author,
			'category' => $quote->category->category
		);

  // Make JSON
  echo json_encode($output);

	}
	else{
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>