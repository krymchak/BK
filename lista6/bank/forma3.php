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
        <title>Info przelewu</title>

    </head>
	<body>
	<div>
	<form action="" method="POST">
		<p>PRELEW UDANY</p>
		<p id="name"><b>Nazwa odbiorcy</b> {{NAME}}</p>
		<p id="number"><b>Numer konta</b> {{NUMBER}}</p>
		<p id="title"><b>Tytul przelewu</b> {{TITLE}}</p>
		<p id="amount"><b>Kwota</b>{{KWOTA}}</p>
		<p><a href="glowna.php">Wrocic do strony glownej</a></p>
	</form>
	</div>
	<script type="text/javascript">
		//var poprawny = localStorage.getItem("number");
		//document.getElementById("number").innerHTML="<b>Numer konta </b>"+ poprawny;
	</script>
	</body>
	</html>
EOT;

$strona=str_replace("{{NAME}}", $name, $strona); 
$strona=str_replace("{{NUMBER}}", $number, $strona);
$strona=str_replace("{{TITLE}}", $title, $strona);
$strona=str_replace("{{KWOTA}}", $amount, $strona);
echo $strona;

$_SESSION["name"]="";
$_SESSION["number"]="";
$_SESSION["title"]="";
$_SESSION["amount"]="";

}
?>