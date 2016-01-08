<?php
	
	session_start();

	$isValid = FALSE;
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

		<a href="">Terug naar overzicht</a>
	
		<?php if (!$isValid): ?>
			<form action="artikel-toevoegen.php" method="POST">
			
						<label for="titel">Titel</label>
						<input type="text" name="titel">
						
						<label for="artikel">Artikel</label>
						<textarea rows="4" id="artikel" name="artikel"></textarea>

						<label for="kernwoorden">Kernwoorden</label>
						<input type="text" name="kernwoorden">

						<label for="datum">Datum</label>
						<input type="date" name="datum" min="1900-12-31" max="2015-12-31"> <!-- In chrome wordt dit een kalender !-->

				<input type="submit" id="submit" name="submit">

			</form>
		<?php else: ?>

			<p class = "succes">Korting toegekend! </p>

		<?php endif ?>
    </body>
</html>