<?php
#Deel 1
$dierenArr1 = array('Koala','Je moeder', 'Koe', 'Kariboo','Kangaroo','Kip','Koningsarend','Koi','Kra Kra','Konijn');

$dierenArr2[0] = 'Koala';
$dierenArr2[1] = 'Je moeder';
$dierenArr2[2] = 'Koe';
$dierenArr2[3] = 'Kariboo';
$dierenArr2[4] = 'Kangaroo';
$dierenArr2[5] = 'Kip';
$dierenArr2[6] = 'Koningsarend';
$dierenArr2[7] = 'Koi';
$dierenArr2[8] = 'Kra Kra';
$dierenArr2[9] = 'Konijn';

$voertuigArr['Landvoertuig']=array('Segway','Scooter');
$voertuigArr['Watervoertuig']=array('Onderduiker');
$voertuigArr['Luchtvoertuig']=array('Heliktoper');
$voertuigArr['Menselijk voertuig']=array('Je moeder');

#Deel 2
$getalArr=array(1,2,3,4,5);

$vermenigvuldigArr=array_product($getalArr); #1. functie maakt automatisch product

$onevenGetalArr=array();

for($i=0;$i<count($getalArr);$i++) #2. oneven getallen worden in aparte array gesaved
{
if($getalArr[$i]%2!=0)
{
	$onevenGetalArr[]=$getalArr[$i];
}
}

$omgekeerdArr = array_reverse($getalArr); #3. functie reversed automatisch

$som = ''; 
for($i=0;$i<count($getalArr)-1;$i++) #4. tel reverse en gewoon met elkaar op
{
	$som+=$getalArr[$i]+$omgekeerdArr[$i];
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
		<p><?= var_dump($voertuigArr)?></p>

		<h2>Deel 2</h2>
		<p><?= $vermenigvuldigArr ?></p>
		<p><?= var_dump($onevenGetalArr) ?></p>
		<p><?= var_dump($omgekeerdArr) ?></p>
		<p><?= $som ?></p>
	</section>

</body>
</html>