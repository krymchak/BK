<?php
session_start();
$name=$_SESSION["name"];
$number=$_SESSION["number"];
$title=$_SESSION["title"];
$amount=$_SESSION["amount"];
przelew($name,$number,$title,$amount);
function przelew ($name, $number, $title, $amount) {
   $strona=
   <<<EOT
	<!DOCTYPE html>
	<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link href="b.css" rel="stylesheet">
        <title>Potwierdzenie przelewu</title>

    </head>
	<body>
	<div>
	<form action="" method="POST">
		<p id="name"><b>Nazwa odbiorcy</b> {{NAME}}</p>
		<p id="number"><b>Numer konta</b> {{NUMBER}}</p>
		<p id="title"><b>Tytul przelewu</b> {{TITLE}}</p>
		<p id="amount"><b>Kwota</b>{{KWOTA}}</p>
		<button id="signin" name = "przelew" type="submit">Przelew</button>
	</form>
	</div>
	<script type="text/javascript">
		//var poprawny = localStorage.getItem("number");
		//document.getElementById("number").innerHTML="<b>Numer konta </b>"+poprawny;
	</script>

	</body>
	</html>
EOT;

$strona=str_replace("{{NAME}}", $name, $strona); 
$strona=str_replace("{{NUMBER}}", $number, $strona);
$strona=str_replace("{{TITLE}}", $title, $strona);
$strona=str_replace("{{KWOTA}}", $amount, $strona);

echo $strona;

if(isset($_POST['przelew']))
{
	$servername = "localhost";
	$username = "root";
	$password = "16121975QwE";
	$dbname = "uzytkownicy";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO przelew (user, name, number, title, amount)
			VALUES ('" . $_COOKIE['username'] . "', '" . $name . "', '". $number . "', '" . $title . "', '" . $amount . "')";
			if ($conn->query($sql) === TRUE) {
				header ('Location: forma3.php');
				exit();
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
}
}
?>