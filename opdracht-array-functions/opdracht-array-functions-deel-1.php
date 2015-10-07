<?php
#Deel 1
$dierenArr = array('Papegaai','Pieterman','Pinguïn','Pissebed','Platvoet','Poes');

$aantalDieren = count($dierenArr);

$teZoekenDier = 'Koe';

$gevonden=false;

if(in_array($teZoekenDier, $dierenArr)==true)
{
$gevonden=true;
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
</head>

<body>
	<section class="body">
		<h1>opdracht-array-basis</h1>
		<h2>Deel 1</h2>
		<p>Er zijn in totaal <?= $aantalDieren ?> dieren</p>
		<p>Het dier <?= $teZoekenDier ?> is <?= $gevonden? "gevonden" : "niet gevonden" ?></p>

	</section>

</body>
</html>