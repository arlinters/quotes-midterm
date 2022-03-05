<?php 
  // Headers
	include_once '../../includes/api_headers.php';
	include_once '../../includes/db_connect.php';
	
	include_once '../../models/Quote.php';


	$quote = new Quote($db);

	$result = $quote->get();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
			'data' => []
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'quote' => $quote,
				'authorId' => $authorId,
				'categoryId' => $categoryId
			];

			array_push($output['data'], $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Quote Found')
		);
	}
?>