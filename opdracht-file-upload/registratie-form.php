<?php

session_start();

// Sessie verwijderen
/*if (isset($_GET['session']))
{
	if($_GET['session'] === 'destroy')
	{
		session_destroy();
		header('Location: registratie-form.php'); // staat in voor refresh
	}
}*/
//in commentaar na debugging^^^

function __autoload($class) //de klasses zijn in een aparte folder, ze werden te groot
{
	require_once('classes/'.$class . '.php');
}

$email = '';
$password = '';

$notification = Notification::getNotification();;

if (isset($_SESSION['registration']))
{
	$email = $_SESSION['registration']['email'];
	$password =	$_SESSION['registration']['password'];
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
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>
<body>

<h1>Registreren</h1>

	<?php if ($notification): ?>
		<div class="regular <?= $notification["type"] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>

	<form action="registratie-proces.php" method="post">
		e-mail<br>
		<input type="text" name="email" id="email" value="<?= $email ?>">
		<br>

		Paswoord<br>
		<input type="<?= ($password != '') ? 'text' : 'password' ?>" name="password" id="password" value="<?= $password ?>">
		<input type="submit" name="password-generator" value="genereer een paswoord">
		<br><br>
		<input type="submit" name="submit" id="submit" value="Registreer">
	</form>

	<!-- VERNIETIG SESSIE (VOOR DEBUGGING) -->
	<!--<a href="registratie-form.php?session=destroy">VERNIETIG SESSIE</a> -->

</body>
</html>