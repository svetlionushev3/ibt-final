<?php 

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
			$name = $_POST['name_'];
		
		$query = "insert into pp (name) values ('$name')";
		$result = pg_query($con, $query);

			header("Location: index.php");
			die;

	}
?>