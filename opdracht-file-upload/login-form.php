<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php'); //misschien de klasses in aparte folder steken
}

$email = '';
$password = '';

$connection = new PDO('mysql:host=localhost;dbname=database-file-upload', 'root', '');
	
if (User::validate($connection)) //controleer cookie
{
	header('location: registratie-dashboard.php');
}

else
{
	$notification = Notification::getNotification();

	if (isset($_SESSION['login']))
	{
		$email = $_SESSION['login']['email'];
		$password = $_SESSION['login']['password'];
	}
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

	<h1>Inloggen</h1>

		<?php if ($notification): ?>
			<div class="regular <?= $notification["type"] ?>">
				<?= $notification['text'] ?>
			</div>
		<?php endif ?>

		<form action="login-process.php" method="post">
				<ul>
					<li>
						<label for="email">e-mail</label>
						<input type="text" name="email" id="email" value="<?= $email ?>">
					</li>
				
					<li>
						<label for="password">paswoord</label>
						<input type="password" name="password" id="password" value="<?= $password ?>">
					</li>
				</ul>
			
				<input type="submit" name="submit" value="Inloggen">
			</form>
		
		<p>Nog geen account? Maak er dan eentje aan op de <a href="registratie-form.php">registratiepagina</a></p>
	</body>
</html>