<?php
$host = "localhost";
$user = "postgres";
$pass = "postgres";
$db = "doctor"; 
$con = pg_connect("host=$host dbname=$db user=$user password=$pass") or die ("Could not connect to server\n");

if (isset($_GET['egn'])) {
    $egn = $_GET['egn'];

    $query = "DELETE FROM patien WHERE egn = $1";

    $result = pg_query_params($con, $query, array($egn));

    if ($result) {
        header('Location: view_and_delete_patient.php');
        exit;
    } else {
        echo "Error deleting patient with EGN: $egn";
    }
} else {
    echo "No EGN provided.";
}

pg_close($con);
?>