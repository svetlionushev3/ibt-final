<?php 
	session_start();
	include("connection.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$f_name = $_POST['f_name']??'';
		$auth_code = $_POST['auth_code']?? '';

		if (!empty($f_name) && !empty($auth_code)) {
			$query = "SELECT * FROM patien WHERE f_name = '$f_name' AND auth_code = '$auth_code' LIMIT 1";
			$result = pg_query($con, $query);

			if ($result && pg_num_rows($result) > 0) {
				$user_data = pg_fetch_assoc($result);
				$_SESSION['patient_egn'] = $user_data['egn']; 
				header("Location: patient_view.php");
				die;
			} else {
				$error = "Грешно име или код!";
			}
		} else {
			$error = "Моля попълнете всички полета.";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Patient</title>
    
	<link rel="stylesheet" href="style.css">
</head>
<body class="login-patient">
    
	<div class="center">
		<h1>Patient Login</h1>
		<form method="post">
			<div class="txt_field">
				<label>First Name</label>
				<input type="text" name="f_name" required>
			</div>
			<div class="txt_field">
				<label>Auth Code</label>
				<input type="text" name="auth_code" required>
			</div>
			<input type="submit" value="Login">
			<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
		</form>
	</div>
</body>
</html>