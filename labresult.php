<?php 
session_start();
include("connection.php");
include("functions.php");

$error = ""; 
$egn = "";   
$labresult_ = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $egn = trim($_POST['egn']);
    $labresult_ = trim($_POST['labresult']);

    if (empty($egn) || empty($labresult_)) {
        $error = "Моля попълнете всички полета.";
    } else {
        $check_query = "SELECT * FROM patien WHERE egn = '$egn'";
        $check_result = pg_query($con, $check_query);

        if (pg_num_rows($check_result) == 0) {
            $error = "Грешка: Няма пациент с такова ЕГН.";
        } else {
            $update = "UPDATE patien SET labresult = '$labresult_' WHERE egn = '$egn'";
            pg_query($con, $update) or die("Cannot execute query: $update\n");
            header("Location: menu.html");
            pg_close($con);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>labresult</title> 
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body class="labresult">
<div class="center">
    <form method="post"> 
        <h1>Set Labresult</h1> 

        <div class="txt_fieldl">
            <label>EGN</label>
            <input id="text" type="text" name="egn" required value="<?php echo htmlspecialchars($egn); ?>"> 
        </div>

        <div class="txt_fieldl">
            <label>Labresult</label>
            <input id="text" type="text" name="labresult" required value="<?php echo htmlspecialchars($labresult_); ?>"> 
        </div>

        <input id="button" type="submit" value="SET"> 
    </form> 

    <?php if (!empty($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="get" action="menu.html">
        <input id="buttonBack1" type="submit" value="Back">
    </form>
</div> 
</body>
</html>
