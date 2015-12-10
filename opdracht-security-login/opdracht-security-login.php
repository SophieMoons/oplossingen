<?php

session_start();

$notification = false;

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
		<div class="regular <?= $errorMessage["type"] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>

	<form action="opdracht-post.php" method="post">
		e-mail<br>
		<input type="text" name="email" id="email">
		<br>

		Paswoord<br>
		<input type="text" name="paswoord" id="paswoord">
		<button>Genereer een paswoord</button>
		<br><br>
		<input type="submit" name="submit" id="submit" value="Registreer">
	</form>
</body>
</html>