<?php
$strona= <<<EOT
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

                    <label id="questionID">{{Q}}</label>
                    <br>	
					<label id="answerID">Odpowiedz na tajne pytanie</label>
                    <input id="answer" name="answer" type="text"/>
                    <br/>
                    <label id="passwordLabelID">Haslo:</label>
                    <input id="password" name="password" type="password"/>
					<label id="passwordLabelID2">Powtorz haslo:</label>
                    <input id="password2" name="password2" type="password"/>
					<br>
					<br/>
                    <button id="signin" name = "zmien" type="submit">Zmien haslo</button>

                </form>
	</body>
	</div>

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

session_start();
$sql = "SELECT pytanie, odpowiedz FROM users WHERE login='".$_SESSION["login"]."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
	$row = $result->fetch_assoc();
	$pytanie=$row["pytanie"];
	$odpowiedz=$row["odpowiedz"];
	$strona=str_replace("{{Q}}", $pytanie, $strona); 
	echo $strona;
	if (isset($_POST['zmien'])) 
	{
		if (isset($_POST['answer']) && isset($_POST['password'])&& isset($_POST['password2']))
		{ 
			if ($_POST['answer']==$odpowiedz)
			{
				if ($_POST['password']==$_POST['password2'])
				{
					$hash = password_hash($_POST['password'], PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
					$sql="UPDATE users SET haslo = '".$hash."' WHERE login='".$_SESSION["login"]."';";
					if ($conn->query($sql) === TRUE) 
					{
						echo "Haslo zmienione";
						header ('Location: index.php');
						exit();
					} 
					else 
					{
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
				else
				{
					echo "hasla sie nie zgadzaja";
				}
			}
			else
			{
				echo "niepoprawna odpowiedz";
			}
		}
		else
		{
			echo "wprowadz dane";
		}
	}
}
else
{
	echo "Uzytkownik z takim loginem nie istnieje";
}
				

?>