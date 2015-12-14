<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php');
}

 spl_autoload_register( '__autoload' );

define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
define( 'HOST', dirname( BASE_URL ) . '/');

$notification = false;

$connection = new PDO('mysql:host=localhost;dbname=database-file-upload', 'root', '');

$userEmail = $_SESSION['registration']['email']; //laat email zien boven dashboard

if (User::validate($connection)) //checkt of de cookie geset is
{
	$notification =	Notification::getNotification();
}

else
{
	User::logout(); //cookie en sessie worden unset

	new notification('error', 'U moet eerst inloggen'); //error wordt aangegeven

	header('location: login-form.php');
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

    <p><a href="registratie-dashboard.php">Dashboard</a> | Ingelogd als <?= $userEmail ?> | <a href="logout.php">uitloggen</a></p>

		<h1>Dashboard</h1>
		
		<?php if (isset($notification)): ?>
			<div class="regular <?= $notification['type'] ?>">
				<?= $notification['text'] ?>
			</div>
		<?php endif ?>
		
		<a href="edit-profile.php">Gegevens wijzigen</a>

	</body>
</head>