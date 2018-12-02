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
		<div>
			<p><a href="forma.php">Nowy przelew</a></p>
			<p><a href="historia.php">Historia przelewow</a></p>
		</div>
	</body>

</html>
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
	$sql = "SELECT * FROM users WHERE login='".$_COOKIE['username']."';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) 
	{
		$row = $result->fetch_assoc();
		if ($_COOKIE['password']==$row["haslo"])
		{
			echo $strona;
		}
		else
		{
			header ('Location: index.php');  // перенаправление на нужную страницу
			exit();
		}
	}
}
?>