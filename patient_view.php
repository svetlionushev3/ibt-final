<?php 
session_start();

if (!isset($_SESSION['patient_egn'])) {
    header("Location: login_patient.php");
    exit();
}

$patient_egn = $_SESSION['patient_egn'];

$host = "localhost";
$user = "postgres";
$pass = "postgres";
$db = "doctor"; 

$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die ("Could not connect to server\n"); 

$query = "SELECT egn, f_name, m_name, l_name, bloodtype, birthdate, alergies, imunization, weight , height, gender, labresult, auth_code FROM patien WHERE egn = '$patient_egn'"; 
$rs = pg_query($con, $query) or die("Cannot execute query: $query\n"); 
?>

<!DOCTYPE html>
<html> 
<head>  
	<meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
	<title>Patient View</title>
</head>
<body> 

	<div class="container">
		<h1>Laboratory Results</h1>

		<form method="post" action="logout_patient.php">
			<button type="submit" class="logout-button2">Logout</button>
		</form>

		<table>
			<tr>
				<th>EGN</th><th>Firstname</th><th>Middlename</th><th>Lastname</th>
				<th>Bloodtype</th><th>Birthdate</th><th>Alergies</th><th>Imunization</th>
				<th>Weight</th><th>Height</th><th>Gender</th><th>Labresult</th><th>Auth Code</th>
			
			</tr>

			<?php 
			while ($row = pg_fetch_row($rs)) {
				echo "<tr>";
				for ($i = 0; $i < count($row); $i++) {
					echo "<td>$row[$i]</td>";
				}
			}
			?>
		</table>
	</div>

</body>
</html>