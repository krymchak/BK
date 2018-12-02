<?php
$strona = 
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
	<form action="" method="POST">

					<label id="emailLabelID">Email:</label>
                    <input id="email" name="email" type="text"/>
                    <br>
                    <label id="usernameLabelID">Login:</label>
                    <input id="username" name="username" type="text"/>
                    <br>
                    <label id="passwordLabelID">Haslo:</label>
                    <input id="password" name="password" type="password"/>
					<label id="passwordLabelID2">Powtorz haslo:</label>
                    <input id="password2" name="password2" type="password"/>
					<br>
					<label id="questionID">Tajne pytanie:</label>
					<select id="question" name="question">
						<option value="Data urodzenia?">Data urodzenia?</option>
						<option value="Imie zwierzaka?">Imie zwierzaka?</option>
					</select>
					<br>
					<label id="answerID">Odpowiedz na tajne pytanie</label>
                    <input id="answer" name="answer" type="text"/>

                    <br/>
					<br/>
                    <button id="signin" type="submit" name="rejestruj">Zarejestruj</button>
					
					<br/>
                    <p><a href="index.php">Logowanie</a></p>

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



if (isset($_POST['rejestruj'])) 
{
	if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['answer'])) 
	{
		$err = array();
		if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['username']))
		{
			$err[] = "Логин может состоять только из букв английского алфавита и цифр";
		}
		if(strlen($_POST['username']) < 3 or strlen($_POST['username']) > 30)
		{
			$err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
		}
		if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['password']))
		{
			$err[] = "Пароль может состоять только из букв английского алфавита и цифр";
		}
		if(strlen($_POST['password']) < 4 or strlen($_POST['password']) > 30)
		{
			$err[] = "Пароль должен быть не меньше 4-х символов и не больше 30";
		}
		$sql = "SELECT * FROM users WHERE login='".$_POST['username']."';";
		$result = $conn->query($sql);
		if($result->num_rows > 0)
		{
			$err[] = "Пользователь с таким логином уже существует в базе данных";
		}
		if ($_POST['password']!=$_POST['password2'])
		{
			$err[] = "Haslo sie nie zgadza";		
		}
		if(count($err) == 0)
		{
			$hash = password_hash($_POST['password'], PASSWORD_ARGON2I, ['memory_cost' => 2048, 'time_cost' => 4, 'threads' => 3]);
			$sql = "INSERT INTO users (email, login, haslo, pytanie, odpowiedz)
			VALUES ('" . $_POST['email'] . "', '" . $_POST['username'] . "', '". $hash ."', '".$_POST['question']."', '".$_POST['answer'].  "')";
		
			if ($conn->query($sql) === TRUE) {
				echo "New record created successfully";
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		else
		{
			print "<b>При регистрации произошли следующие ошибки:</b><br>";

			foreach($err AS $error)

			{

				print $error."<br>";

			}
		}
	}
	else 
	{
		echo("Nie wprowadzono dane");
	}
}

echo $strona;

$conn->close();
?>