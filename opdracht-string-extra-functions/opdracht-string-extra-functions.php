<?php
#deel 1.
$fruit = 'kokosnoot';
$aantalCharsFruit = strlen($fruit);
$posFruit = strpos( $fruit,'o');

#deel 2.
$fruit2 = 'ananas';
$posFruit2 = strrpos($fruit2,'a');
$capitalFruit2 = strtoupper($fruit2);

#deel 3.
$lettertje = 'e';
$cijfertje = 3;
$langsteWoord ='zandzeepsodemineralenwatersteenstralen';
$vervangLangsteWoord =  str_replace(($lettertje), $cijfertje,$langsteWoord);

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

	<section>

		<h1>opdracht-string-extra-functions</h1>
		
		<h2>Deel 1.</h2>
		<p><?= $aantalCharsFruit ?></p> 
		<p><?= $posFruit ?></p> 

		<h2>Deel 2.</h2>
		<p><?= $posFruit2 ?></p> 
		<p><?= $capitalFruit2 ?></p> 

		<h2>Deel 3.</h2>
		<p><?= $vervangLangsteWoord ?></p> 

	</section>

</body>
</html>
