<?php
	$password		= 	'godverdommeseklote';
	$username 		= 	'stijn';
	$message = 'Inloggen vereist';
	
	if(isset($_POST['submit'])) #controle om error te vermijden
	{
		if(($_POST['username'])==$username && ($_POST['paswoord'])==$password)
		{
			$message = 'Log in succesvol!';
		}

		else
		{
			$message = 'Paswoord of username incorrect, probeer opnieuw';
		}
	}

	/*var_dump('username');
	var_dump('paswoord');*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>
<body>

<h1>Inloggen</h1>
<p><?= $message?></p>
	<form action="opdracht-post.php" method="post">
Gebruikersnaam<br>
<input type="text" name="username" id="username">
<br>
Paswoord<br>
<input type="text" name="paswoord" id="paswoord">
<br><br>
<input type="submit" name="submit" id="submit">
</form>
</body>
</html>