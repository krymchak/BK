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

                    <br/>
					<br/>
                    <button id="signin" name = "zmien" type="submit">Zmien haslo</button>

                </form>
	</body>
	</div>

</html>
EOT;

if(isset($_POST['username']))
{
	session_start();
	$_SESSION["login"]=$_POST['username'];
	header ('Location: zmianahasla2.php');  // перенаправление на нужную страницу
	exit();
}


?>