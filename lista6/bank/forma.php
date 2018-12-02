<?php
$strona=
<<<EOT
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link href="b.css" rel="stylesheet">
        <title>Przelew</title>

    </head>
	<body>
	<div>
<form action="" method="POST">

                    <label id="nameID">Nazwa odbiorcy:</label>
                    <input id="name" name="name" type="text"/>
                    <br>
                    <label id="numberID">Numer konta:</label>
                    <input id="number" name="number" type="text"/>
					<br>
					<label id="titleId">Tytul przelewu:</label>
                    <input id="title" name="title" type="text"/>
					<br>
					<label id="amountID">Kwota przelewu:</label>
                    <input id="amount" name="amount" type="number"/>

                    <br/>
					<br/>
                    <button id="signin" name = "przelew" type="submit" >Przelew</button>
                </form>
		</div>
				<script type="text/javascript">
				//var change = function()
				//{
				//		var poprawny = document.getElementById('number').value;
				//		document.getElementById('number').value = '1234';
				//		localStorage.setItem('number', poprawny);
				//}
				//document.getElementById('signin').onclick = change;
				</script>
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
			header ('Location: index.php');
			exit();
		}
	}
}
else
{
	header ('Location: index.php');
	exit();
}

if(isset($_POST['przelew']))
{
	if (isset($_POST['name']) && isset($_POST['amount']) && isset($_POST['title']) && isset($_POST['number'])) 
	{
		session_start();
		$_SESSION["name"]=$_POST['name'];
		$_SESSION["amount"]=$_POST['amount'];
		$_SESSION["title"]=$_POST['title'];
		$_SESSION["number"]=$_POST['number'];
		header ('Location: forma2.php');  // перенаправление на нужную страницу
		exit();
	}
	else
	{
		echo "wprowadz dane";
	}
}
?>