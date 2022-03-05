<?php 
	include_once '../../includes/api_headers.php';
	include_once '../../includes/db_connect.php';
	include_once '../../models/Category.php';

	$category = new Category($db);

	$result = $category->get();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
			'data' => []
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'category' => $category,
			];

			array_push($output['data'], $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Categories Found')
		);
	}

	?> 