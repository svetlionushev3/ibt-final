<!DOCTYPE html>
<html> 
<head>  
	<link rel="stylesheet" href="style.css">
	<title>View and Delete Patient</title>
</head>
<body class="view_and_delete_patient"> 
	<h1>View and Delete Patient</h1> 

	<form method="get" action="menu.html">
		<button id="buttonBack" type="submit">Back</button>
	</form>

	<?php 
		$host = "localhost";
		$user = "postgres";
		$pass = "postgres";
		$db = "doctor"; 

		$con = pg_connect("host=$host dbname=$db user=$user password=$pass")
			or die ("Could not connect to server\n"); 

		$query = "SELECT egn, f_name, m_name, l_name, bloodtype, birthdate, alergies, imunization, weight, height, gender, labresult, auth_code FROM patien"; 
		$rs = pg_query($con, $query) or die("Cannot execute query: $query\n");
	?>

	<table>
		<tr>
			<th>EGN</th>
			<th>Firstname</th>
			<th>Middlename</th>
			<th>Lastname</th>
			<th>Bloodtype</th>
			<th>Birthdate</th>
			<th>Alergies</th>
			<th>Imunization</th>
			<th>Weight</th>
			<th>Height</th>
			<th>Gender</th>
			<th>Labresult</th>
			<th>Auth Code</th>
			<th>Delete</th>
		</tr>

		<?php 
		while ($row = pg_fetch_row($rs)) {
			echo "<tr>";
			for ($i = 0; $i < count($row); $i++) {
				echo "<td>$row[$i]</td>";
			}
			echo "<td><a href='delete.php?egn=$row[0]'>Delete</a></td>";
			echo "</tr>";
		}
		?>
	</table>
</body>   
</html>
