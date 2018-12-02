<?php
echo <<<EOT
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link href="b.css" rel="stylesheet">
        <title>Bank</title>

    </head>
	<body>
	<div>
	<form action="" method="POST">

                    <label id="usernameLabelID">Login:</label>
                    <input id="username" name="username" type="text"/>
                    <br>
                    <label id="passwordLabelID">Haslo:</label>
                    <input id="password" name="password" type="password"/>

                    <br/>
					<br/>
                    <button id="signin" name = "loguj" type="submit">Zaloguj</button>
					
					<br/>
                    <p><a href="zmianahasla.php">Nie pamiętam hasła</a></p>
                    <p><a href="rejestracja.php">Rejestracja</a></p>

                </form>
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

if (isset($_POST['loguj'])) 
{
	if (isset($_POST['username']) && isset($_POST['password']))
	{ 
			$sql = "SELECT * FROM users WHERE login='".$_POST['username']."';";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) 
			{
				$row = $result->fetch_assoc();
				if(password_verify($_POST['password'], $row["haslo"]))
				{
					setcookie("password", $row["haslo"], time()+60*15);
					setcookie("username", $_POST['username'], time()+60*15);
					header ('Location: glowna.php');  // перенаправление на нужную страницу
					exit();
				}
				else
					echo "niepoprawne haslo lub login";
			} else 
			{
				echo "niepoprawne haslo lub login";
			}
	}
	else 
	{
		echo("Nie wprowadzono dane");
	}
}

?>