<?php

	$tekst = file_get_contents('text.txt');
	$inlogData = explode(",", $tekst);

	$username = $inlogData[0];
	$password = $inlogData[1];
	
	$message = '';

	$title ='Inloggen';

	#$correct = false; #vervang door isAuthenticated

	$blank = true;

	$isAuthenticated = false;


	if(isset($_POST['submit']))
	{
		$blank=false;

		if(($_POST['username'])==$username && ($_POST['paswoord'])==$password)
		{
			setcookie('authenticated', true, time() + 60);

			$title='Dashboard';
			$message = 'U bent ingelogd';
			#$correct = true; # weg,vervang door isAuthenticated
		}

		else
		{
			$message = 'Paswoord of username incorrect, probeer opnieuw';
			#$correct = false; # weg, vervang door isAuthenticated
		}
	}

	if (var_dump(isset($_GET['cookie']))) 
	{
		if ($_GET['cookie'] == 'delete') #bij uitloggen...
		{
			setcookie('authenticated','', time() - 3600);
			header('location: opdracht-cookies.php');
		}
	}

	if (isset( $_COOKIE['authenticated'])) 
	{
		$isAuthenticated = true;
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">

	<style>
		#false 
		{
			font color: #B22222;
			background-color: #F08080;
			padding: 5px;
			max-width: 500px;
			border-radius: 5px;
		}

	</style>

</head>
<body>

<h1><?= $title?></h1>
	<p id= <?php if($blank): ?>"blank"
			
			<?php else: ?>
			
				"<?php echo (!$isAuthenticated) ? 'false': 'correct' ; ?>"
			
			<?php endif?>> <?= $message?> </p>

		<?php if(!$isAuthenticated):?>

			<form action="opdracht-cookies.php" method="post">
				Gebruikersnaam<br>
				<input type="text" name="username" id="username">
				<br>
				Paswoord<br>
				<input type="text" name="paswoord" id="paswoord">
				<br><br>
				<input type="submit" name="submit" id="submit">
		<?php endif?>	

				<?php if($isAuthenticated): ?>

					<a href="opdracht-cookies.php?cookie=delete">Uitloggen</a>

				<?php endif?>
		</form>
</body>
</html>