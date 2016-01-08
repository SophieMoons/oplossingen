<?php
	
	session_start();

	$isValid = false;

	$notification=false;

	if(isset($_SESSION['fieldNames']))
	{
		$titel = $_SESSION['fieldNames']['titel'];
		$artikel = $_SESSION['fieldNames']['artikel'];
		$kernwoorden = $_SESSION['fieldNames']['kernwoorden'];
		$datum = $_SESSION['fieldNames']['datum']; //moet nog worden omgezet naar value, geeft nu null
	}

	if(isset($_SESSION['notification'])) //als er een notificatie is...
	{
		$notification['type'] = $_SESSION['notification']['type'];
		$notification['text'] = $_SESSION['notification']['text'];

		unset($_SESSION['notification']); //terug unsetten hierna
	}

	var_dump($datum);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    	<link rel="stylesheet" href="http://web-backend.local/css/facade.css">
   		<link rel="stylesheet" href="http://web-backend.local/css/directory.css">
   		<link rel="stylesheet" href="css/stylesheet.css">
    </head>
    <body>

		<h1>Artikel toevoegen</h1>

		<?php if ($notification): ?>
			<div class="regular <?= $notification['type'] ?>">
				<?= $notification['text'] ?>
			</div>
		<?php endif ?>

		<a href="">Terug naar overzicht</a>
	
		<?php if (!$isValid): ?>
			<form action="artikel-toevoegen-form.php" method="POST">
			
						<label for="titel">Titel</label>
						<input type="text" name="titel">
						
						<label for="artikel">Artikel</label>
						<textarea rows="4" id="artikel" name="artikel"></textarea>

						<label for="kernwoorden">Kernwoorden</label>
						<input type="text" name="kernwoorden">

						<label for="datum">Datum</label>
						<input type="date" name="datum" min="2016-01-01"> <!-- In chrome wordt dit een kalender !-->

				<input type="submit" id="submit" name="submit">

			</form>
		<?php else: ?>

			<p class = "succes">Artikel toegevoegd!</p>

		<?php endif ?>
    </body>
</html>