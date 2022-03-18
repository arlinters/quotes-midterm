<?php 

	$quote = new Quote($db);

	// Filter request based on GET parameters in request
	if(isset($_GET['authorId']) && isset($_GET['categoryId'])){
		$result = $quote->getAllByAuthorIdAndCategoryId($_GET['authorId'], $_GET['categoryId']);
	}
	elseif(isset($_GET['authorId'])){
		$result = $quote->getAllByAuthorId($_GET['authorId']);
	}
	elseif(isset($_GET['categoryId'])){

		$result = $quote->getAllByCategoryId($_GET['categoryId']);
	}
	else{
		$result = $quote->getAll();
	}

	$num = $result->rowCount();

	if($num > 0){
		$output = [
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => (int)$id,
				'quote' => $quote,
				'author' => $author,
				'category' => $category
			];

			array_push($output, $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Quotes Found')
		);
	}
?>