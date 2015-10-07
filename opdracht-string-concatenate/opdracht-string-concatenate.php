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
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>
</head>
<body>
	
	<section>

		<h1>opdracht-concatenate-string</h1>

<p><?= $volledigeNaam ?></p>
<p><?= strlen($volledigeNaam)?></p>

	</section>

</body>
</html>