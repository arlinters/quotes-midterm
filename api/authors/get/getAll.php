<?php
include_once '../../includes/api_headers.php';
include_once '../../includes/db_connect.php';
include_once '../../models/Author.php';

	$author = new Author($db);
	$result = $author->getAll();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
			'data' => []
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'author' => $author,
				'METHOD' => $_SERVER['REQUEST_METHOD']
			];

			array_push($output['data'], $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>