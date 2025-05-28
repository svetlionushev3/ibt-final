<?php
function check_login($con)
{
	if(isset($_SESSION['user_id']))
	{
		$id = $_SESSION['user_id'];
		$query = "select * from doctor where user_id = '$id' limit 1";
		$result = pg_query($con,$query);
		if($result && pg_num_rows($result) > 0)
		{

			$user_data = pg_fetch_assoc($result);
			return $user_data;
		}
	}
	header("Location: login.php");
	die;
}
function random_num($length)
{
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}
	$len = rand(4,$length);
	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}
	return $text;
}