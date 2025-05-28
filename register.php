<?php
	session_start();
	include("connection.php");
	include("functions.php");
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$f_name_ = $_POST['f_name'];
		$m_name_ = $_POST['m_name'];
		$l_name_ = $_POST['l_name'];
		$email_ = $_POST['email'];
		$password_ = $_POST['password'];
		if(!empty($egn_) && !empty($f_name_) && !empty($m_name_) && !empty($l_name_) && !empty($email_) && !empty($password_)&& !empty($specialization_))
		{
			$user_id = random_num(20);
            $query = "insert into doctor (egn,f_name,m_name,l_name,email,password,spec,user_id) values ('$egn_','$f_name_','$m_name_','$l_name_','$email_','$password_','$specialization_','$user_id')";
			pg_query($con, $query);
			header("Location: index.php");
			die;
		}
		else
		{
			echo "wrong data!";
			
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Signup</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="center"> 
	 <h1>Signup</h1>
		<form method="post"> 
		<div class="txt_fieldl"> 
			<label>Firstname:</label>
			<input id="text" type="text" name="f_name">  
			</div>
		<div class="txt_fieldl"> 
			<label>Middlename:</label>
			<input id="text" type="text" name="m_name">  
			</div>
		<div class="txt_fieldl"> 
			<label>Lastname:</label>
			<input id="text" type="text" name="l_name">  
			</div>
		<div class="txt_fieldl"> 
			<label>Email:</label>
			<input id="text" type="text" name="email">  
			</div>
		<div class="txt_fieldl"> 
			<label>Password:</label>
			<input id="text" type="password" name="password">  
			</div>
			<input id="button" type="submit" value="Signup"> 
			<div class="signup_link">
			<a href="index.php">Click to Login</a> 
			</div> 

		</form>
	</div> 
</body>
</html>
