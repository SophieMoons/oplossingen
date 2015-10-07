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
<head></head>
<body>

<h1>Inloggen</h1>
<p><?php echo($message)?></p>
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