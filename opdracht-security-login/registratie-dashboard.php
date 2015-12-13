<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php');
}

$connection = new PDO('mysql:host=localhost;dbname=database-security-login', 'root', '');

if (User::validate($connection)) //checkt of de cookie geset is
{
	$notification =	notification::getNotification();
}

else
{
	User::logout(); //cookie en sessie worden unset

	new notification('error', 'Inloggen mislukt, probeer het opnieuw'); //error wordt aangegeven

	header('location: opdracht-security-login-form.php'); //niet vergeten!!
}

var_dump($_SESSION);

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

		<h1>Dashboard</h1>
		
		<?php if (isset($notification)): ?>
			<div class="regular <?= $notification['type'] ?>">
				<?= $notification['text'] ?>
			</div>
		<?php endif ?>
		
		<a href="opdracht-security-logout.php">uitloggen</a>

	</body>
</head>