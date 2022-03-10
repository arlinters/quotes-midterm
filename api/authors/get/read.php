<?php


	$author = new Author($db);
	$result = $author->getAll();
	$num = $result->rowCount();

	if($num > 0){
		$output = [
		];

		while($row = $result->fetch(PDO::FETCH_ASSOC)){
			extract($row);
			$item = [
				'id' => $id,
				'author' => $author,
			];

			array_push($output, $item);
		}

		echo json_encode($output);
	}
	else{
		echo json_encode(
			array('message' => 'No Authors Found')
		);
	}
?>