<?php 

	$category = new Category($db);

	$result = $category->getAll();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'category' => $category,
			];

			array_push($output, $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Categories Found')
		);
	}

	?> 