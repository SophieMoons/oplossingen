<?php
#Deel 1
$md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
$needle1 = 2;
$needle2 =8;
$needle3='a';

function percentageOccurance($needle) #je moet toch maar 1 functie maken? De argumenten zijn gewoon anders
{
	global $md5HashKey; #ook global variabele nu
	$occurenceNeedle = substr_count($md5HashKey, $needle);
	$percentOcc = ($occurenceNeedle/(strlen($md5HashKey))*100);

	$resultaat=$percentOcc;
	return $resultaat;
}

$uitkomst1 = percentageOccurance($needle1);
$uitkomst2 = percentageOccurance($needle2);
$uitkomst3 = percentageOccurance($needle3);

#Deel 2
/*global $pigHealth;
global $maximumThrows;

function calculateHit()
{
$pigHealth=5;
$maximumThrows=8;
}

function rand()
{
	
}
*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	
	<section class="body">
		<h1>opdracht-functions-gevorderd</h1>
		<h2>Deel 1</h2>
		<p>Functie 1: De needle <?= $needle ?> komt <?= $uitkomst1 ?>% voor in de hash key: <?= $md5HashKey ?></p> <!--nu is de tekst flexibel !-->
		<p>Functie 2: De needle <?= $needle ?> komt <?= $uitkomst2 ?>% voor in de hash key: <?= $md5HashKey ?></p>
		<p>Functie 3: De needle <?= $needle ?> komt <?= $uitkomst3 ?>% voor in de hash key: <?= $md5HashKey ?></p>


		<h2>Deel 2</h2>
		<p></p>

	</section>

</body>
</html>