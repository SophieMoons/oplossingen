<?php
session_start();

$notification=false;

if(isset($_SESSION['fieldNames']))
{
	$email = $_SESSION['fieldNames']['email'];
	$message = $_SESSION['fieldNames']['message'];
	$sendCopy =	$_SESSION['fieldNames']['sendCopy'];

	var_dump($message);
}

if(isset($_SESSION['notification'])) //als er een notificatie is...
{
	$notification['type'] = $_SESSION['notification']['type'];
	$notification['text'] = $_SESSION['notification']['text'];

	unset($_SESSION['notification']); //terug unsetten hierna
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

<h1>Contacteer ons</h1>

	<?php if ($notification): ?>
		<div class="regular <?= $notification['type'] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>

	<form action="opdracht-mail.php" method="post">
		<ul>			
			<li>
				<label for="email">E-mailadres</label>
				<input type="text" id="email" name="email" value="<?php echo (isset($email)) ? $email : '' ?>">
			</li>
			
			<li>
				<label for="message">Boodschap</label>
				<textarea id="message" name="message"><?php echo (isset($message)) ? $message : '' ?></textarea>
			</li>
			
			<li>
				<label for="send-copy">Stuur een kopie naar mezelf</label>
				<input type="checkbox" id="sendCopy" name="sendCopy" <?php echo (isset($sendCopy)) ? 'checked' : '' ?>>
			</li>	
		</ul>
		
		<input type="submit" id="submit" name="submit">

	</form>
</body>
</html>