<?php
$strona=
   <<<EOT
	<!DOCTYPE html>
	<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link href="b.css" rel="stylesheet">
        <title>Bank</title>

    </head>
	<body>
	{{HISTORIA}}
	<p><a href="glowna.php">Wrocic do strony glownej</a></p>
	</body>
	</html>
EOT;
$przelew=
<<<EOT
	<div>
		<p>PRELEW {{N}}</p>
		<p><b>Nazwa odbiorcy</b> {{NAME}}</p>
		<p><b>Numer konta</b> {{NUMBER}}</p>
		<p><b>Tytul przelewu</b> {{TITLE}}</p>
		<p><b>Kwota</b> {{KWOTA}}</p>
	</div>
EOT;

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
if (isset($_COOKIE['username']) and isset($_COOKIE['password']))
{
	$przelewy="";
	$n=1;
	$sql = "SELECT * FROM przelew WHERE user='".$_COOKIE['username']."';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
			while($row = $result->fetch_assoc())
			{
					$przelew2=str_replace("{{N}}", $n, $przelew); 
					$przelew2=str_replace("{{NAME}}", $row["name"], $przelew2); 
					$przelew2=str_replace("{{NUMBER}}", $row["number"], $przelew2);
					$przelew2=str_replace("{{TITLE}}", $row["title"], $przelew2);
					$przelew2=str_replace("{{KWOTA}}", $row["amount"], $przelew2);
					$n=$n+1;
					$przelewy.=$przelew2;
			
			}
	}

	$strona=str_replace("{{HISTORIA}}", $przelewy, $strona); 

	echo $strona;
}
else
{
	header ('Location: index.php');
	exit();
}

?>