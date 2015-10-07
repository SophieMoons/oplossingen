<?php

#Deel 1
$getalArr=array();

$getalLijst='';

for($i=0;$i<101;$i++) #for is hier veel beter voor
{
	$getalArr[]=($i);
}

	$getalLijst	=	implode( ', ', $getalArr);

#Deel 2
$boodschappenlijstje = array('chippekens','kroepoek','wafeltjens','kabeljauwhaasje');

$counterGetal=0;

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
		<h1>opdracht-looping-statements-while</h1>
		<h2>Deel 1</h2>
		<p><?= $getalLijst ?></p>

		<h2>Deel 2</h2>
		<ul>
			<?php while( isset( $boodschappenlijstje [ $counterGetal ] ) ):  ?>
						<li><?= $boodschappenlijstje [ $counterGetal ] ?></li>
					<?php $counterGetal++; ?>
			<?php endwhile ?>
		</ul>

	</section>

</body>
</html>