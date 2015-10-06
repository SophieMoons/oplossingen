<?php
#Deel 2
$dierenArr = array('Papegaai','Pieterman','Pinguïn','Pissebed','Platvoet','Poes');

$zoogdieren=array('Kat','Kobi Koe','Konijn');

$dierenLijst =array_merge($dierenArr,$zoogdieren);
$aantalTotDieren = count($dierenLijst);

#Deel 3
$getalArr=array(8,7,8,7,3,2,1,2,4);
$getalCleanArr=array_unique($getalArr);
arsort($getalCleanArr);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	
	<section class="body">
		<h1>opdracht-array-basis</h1>
		<h2>Deel 2</h2>
		<p>Er zijn in totaal (zoogdieren en andere) <?php echo ($aantalTotDieren)?> dieren</p>
		<p><?php echo var_dump($dierenLijst)?></p>

		<h2>Deel 3</h2>
		<p><?php echo var_dump($getalCleanArr)?></p>

	</section>

</body>
</html>