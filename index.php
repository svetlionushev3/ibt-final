<?php 
	session_start();
	include("connection.php");
	include("functions.php");
	$error = ""; 

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (!empty($email) && !empty($password) && !is_numeric($email)) {
			$query = "SELECT * FROM doctor WHERE email = '$email' LIMIT 1";
			$result = pg_query($con, $query);
			if ($result) {
				if ($result && pg_num_rows($result) > 0) {
					$user_data = pg_fetch_assoc($result);	
					if ($user_data['password'] === $password) {
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: menu.html");
						die;
					}
				}
			}
			$error = "Wrong username or password!"; 
		} else {
			$error = "Please enter valid username and password."; 
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login doctor</title>  
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">	 
</head>
<body class="login-doctor"> 

	<div class="center">
		<h1>Login Doctor</h1>

		<?php if (!empty($error)): ?> 
			<div class="error-message">
				<?php echo $error; ?>
			</div>
		<?php endif; ?>

		<form method="post"> 
			<div class="txt_field"> 
				<label>Email</label>
				<input id="text" type="text" name="email" required>
			</div> 
			<div class="txt_field">  
				<label>Password</label>
				<input id="text" type="password" name="password" required>        
			</div>
			<input id="button" type="submit" value="Login Doctor">
			<div class="signup_link">
				Not a member? <a href="signup-doctor.php">Signup</a>
			</div>
		</form>
	</div>
</body>
</html>
