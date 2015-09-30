<?php
$voornaam = 'Sophie';
$achternaam ='Moons';

$volledigeNaam = $voornaam .'&nbsp'. $achternaam;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	
	<section>

		<h1>opdracht-concatenate-string</h1>

<p><?php echo($volledigeNaam) ?></p>
<p><?php echo(strlen($volledigeNaam))?></p>

	</section>

</body>
</html>