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
</head>
<body>

	<section>

		<h1>opdracht-string-extra-functions</h1>
		
		<h2>Deel 1.</h2>
		<p><?php echo( $aantalCharsFruit) ?></p> 
		<p><?php echo( $posFruit) ?></p> 

		<h2>Deel 2.</h2>
		<p><?php echo( $posFruit2) ?></p> 
		<p><?php echo( $capitalFruit2) ?></p> 

		<h2>Deel 3.</h2>
		<p><?php echo($vervangLangsteWoord) ?></p> 

	</section>

</body>
</html>
