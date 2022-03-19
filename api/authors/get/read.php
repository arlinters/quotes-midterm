<?php


	$author = new Author($db);
	// Get all items
	$result = $author->getAll();
	$num = $result->rowCount();

	if($num > 0){
		// Output object for holding authors
		$output = [
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			// Extract the row and insert it into the output array
			extract($row);
			$item = [
				'id' => $id,
				'author' => $author,
			];

			array_push($output, $item);
		}

		// Return the array resposne
		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>