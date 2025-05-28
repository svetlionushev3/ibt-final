<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $egn_ = $_POST['egn'];
    $f_name_ = $_POST['f_name'];
    $m_name_ = $_POST['m_name'];
    $l_name_ = $_POST['l_name'];
    $email_ = $_POST['email'];
    $password_ = $_POST['password'];
    $specialization_ = $_POST['specialization'];

    if (
        !empty($egn_) && !empty($f_name_) && !empty($m_name_) &&
        !empty($l_name_) && !empty($email_) && !empty($password_) &&
        !empty($specialization_)
    ) {
        $user_id = random_num(20);

        $query = "INSERT INTO doctor (egn, f_name, m_name, l_name, email, password, spec, user_id)
                  VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

        $result = pg_query_params($con, $query, [
            $egn_, $f_name_, $m_name_, $l_name_,
            $email_, $password_, $specialization_, $user_id
        ]);

        if ($result) {
            header("Location: index.php");
            exit;
        } else {
            $error_message = "Грешка при запис в базата: " . pg_last_error($con);
        }
    } else {
        $error_message = "Моля попълнете всички полета.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="signup-page">
	<div class="center"> 
		<h1>Signup</h1>

		<?php if(isset($error_message)): ?>
			<div class="error-message"><?php echo $error_message; ?></div>
		<?php endif; ?>

		<form method="post"> 
			<div class="txt_fieldl"> 
				<label>EGN:</label>
				<input id="text" type="text" name="egn" required> 
			</div> 
			<div class="txt_fieldl"> 
				<label>Firstname:</label>
				<input id="text" type="text" name="f_name" required>  
			</div>
			<div class="txt_fieldl"> 
				<label>Middlename:</label>
				<input id="text" type="text" name="m_name" required>  
			</div>
			<div class="txt_fieldl"> 
				<label>Lastname:</label>
				<input id="text" type="text" name="l_name" required>  
			</div>
			<div class="txt_fieldl"> 
				<label>Email:</label>
				<input id="text" type="text" name="email" required>  
			</div>
			<div class="txt_fieldl"> 
				<label>Password:</label>
				<input id="text" type="password" name="password" required>  
			</div>
			<div class="txt_fieldl"> 
				<label>Specialization</label>
				<input id="text" type="text" name="specialization" required> 
			</div>
			<input id="button" type="submit" value="Signup"> 
			<div class="signup_link">
				<a href="index.php">Click to Login</a> 
			</div> 
		</form>
	</div> 
</body>
</html>
