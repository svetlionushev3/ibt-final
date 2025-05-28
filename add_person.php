<?php 
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $egn = $_POST['egn'];
    $f_name = $_POST['f_name'];
    $m_name = $_POST['m_name'];
    $l_name = $_POST['l_name'];
    $bloodtype = $_POST['bloodtype'];
    $birthdate = $_POST['birthdate'];
    $alergies = $_POST['alergies'];
    $imunization = $_POST['imunization'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $gender = $_POST['gender'];
    $labresult = 'Nothing';
    $auth_code = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 8);

    $query = "INSERT INTO patien (egn,f_name,m_name,l_name,bloodtype,birthdate,alergies,imunization,weight,height,gender,labresult, auth_code) 
              VALUES ('$egn','$f_name','$m_name','$l_name','$bloodtype','$birthdate','$alergies','$imunization','$weight','$height','$gender','$labresult', '$auth_code')";
    pg_query($con, $query);
    header("Location: menu.html");
    die;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>add_patient</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="add_patient">

    <div class="center">
        <div class="form-container">
            <form method="post"> 
                <h1>Add patient</h1>
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
                    <label>Bloodtype:</label>
                    <input id="text" type="text" name="bloodtype" required>
                </div>
                <div class="txt_fieldl"> 
                    <label>Birthday:</label>
                    <input id="text" type="text" name="birthdate" required>
                </div>
                <div class="txt_fieldl"> 
                    <label>Alergies:</label>
                    <input id="text" type="text" name="alergies" required>
                </div>
                <div class="txt_fieldl"> 
                    <label>Immunization:</label>
                    <input id="text" type="text" name="imunization" required>
                </div>
                <div class="txt_fieldl"> 
                    <label>Weight:</label>
                    <input id="text" type="text" name="weight" required>
                </div>
                <div class="txt_fieldl">  
                    <label>Height:</label>
                    <input id="text" type="text" name="height" required> 
                </div>
                <div class="txt_fieldl">  
                    <label>Gender:</label>
                    <input id="text" type="text" name="gender" required> 
                </div> 

                <input id="button" type="submit" value="Add patient">  
            
            </form> 

            <form method="get" action="menu.html"> 
                <input id="buttonBack1" type="submit" value="Back">
            </form>
        </div>
    </div>

</body>
</html>
