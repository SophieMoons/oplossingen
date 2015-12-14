<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php');
}

 spl_autoload_register( '__autoload' );

define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
define( 'HOST', dirname( BASE_URL ) . '/');

$connection = new PDO('mysql:host=localhost;dbname=database-file-upload', 'root', '');

$user = new User();

$userEmail = User::getEmail();//$_SESSION['login']['email']; //laat email zien boven dashboard, de login array zijn gegevens komen van de dehashing van de cookie -> technisch gezien uit cookie gehaald?

$userProfilePic = User::getId(); //''; //profilePicture // ^ GERAAK ER NOG NIET AAN 

if (User::validate($connection)) //checkt of de cookie geset is
{
	$notification =	Notification::getNotification();
}

else
{
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

		<h1>Gegevens wijzigen</h1>
		
		<?php if ($notification): ?>
			<div class="regular <?= $notification['type'] ?>">
				<?= $notification['text'] ?>
			</div>
		<?php endif ?>
		
		<form action="edit-profile-process.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="profilePicture">Profielfoto</label>
                <img src="img/<?=($userProfilePic !== '') ? $userProfilePic : 'defaultProfilePic.png' ?>" alt="">
            </li>

            <li>
            	<input type="file" id="profilePicture" name="profilePicture">
            </li>

            <li>
            	<label for="email">e-mail</label>
				<input type="text" name="email" id="email" value="<?= $userEmail ?>">
			</li>
        </ul>
        <input type="submit" value="Gegevens wijzigen" name="submit">
    </form>

	</body>
</head>