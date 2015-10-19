<?php

	session_start();

	#Sessie verwijderen
	if (isset($_GET['session']))
	{
		if($_GET['session'] === 'destroy')
		{
			session_destroy();
			header('Location: opdracht-sessions-registratie.php'); #voor refresh
		}
	}
	
	#check eerst of deze geset zijn, dan slaag je gegevens op in sessie
	if(isset($_SESSION['account']['registratie']['email']))
	{
		$email = $_SESSION['account']['registratie']['email'];
	}
	
	if(isset($_SESSION['account']['registratie']['nickname']))
	{
		$nickname = $_SESSION['account']['registratie']['nickname'];
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
		.fail 
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
    </head>
    <body>
		
		<a href="opdracht-sessions-registratie.php?session=destroy">Vernietig sessie</a>
		
		<h1>Deel 1: Registratiegegevens</h1>

		<form action="opdracht-sessions-adres.php" method="POST"> <!-- processing van data gebeurd in php deel 2!-->
			
			<ul>
				<li>
					<label for="email">email</label>
					<input type="text" id="email" name="email"> <!-- value="<?= $email ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "email" ) ? 'autofocus' : '' ?>!-->
				</li>
				<li>
					<label for="nickname">nickname</label>
					<input type="text" id="nickname" name="nickname"> <!-- value="<?= $nickname ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == "nickname" ) ? 'autofocus' : '' ?> !-->
				</li>
			</ul>

			<input type="submit" name="submit" id="submit" value="Verstuur">

		</form>

		
    </body>
</html>