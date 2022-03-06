<?php 

	$quote = new Quote($db);

	$result = $quote->getAll();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'quote' => $quote,
				'authorId' => $authorId,
				'categoryId' => $categoryId
			];

			array_push($output, $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Quote Found')
		);
	}
?>