<?php
#Deel 1
global $md5HashKey;

function percentageOccurance($needle) #je moet toch maar 1 functie maken? De argumenten zijn gewoon anders
{
	$md5HashKey='d1fa402db91a7a93c4f414b8278ce073';
	$occurenceNeedle = substr_count($md5HashKey, $needle);
	$percentOcc = ($occurenceNeedle/(strlen($md5HashKey))*100);

	$resultaat='De needle '.$needle.' komt '.$percentOcc.'%'.' voor in de hash key: '.$md5HashKey; 
	#$resultaat=array($needle,$percenOcc,$md5HashKey);
	return $resultaat;
}


$uitkomst1 = percentageOccurance('2');
$uitkomst2 = percentageOccurance('8');
$uitkomst3 = percentageOccurance('a');

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
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>

<body>
	
	<section class="body">
		<h1>opdracht-functions-gevorderd</h1>
		<h2>Deel 1</h2>
		<p>Functie 1: <?= $uitkomst1 ?></p> <!--echo() is niet zo goed, liefst kortere versie met = !-->
		<p>Functie 2: <?= $uitkomst2 ?></p>
		<p>Functie 3: <?= $uitkomst3 ?></p>


		<h2>Deel 2</h2>
		<p></p>

	</section>

</body>
</html>