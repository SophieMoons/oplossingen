<?php

#deel 1
$randGetal = rand(1,100);

$tussenGetal1=10;
$tussenGetal2=20;
$tussenGetal3=30;
$tussenGetal4=40;

$grens1='';
$grens2='';

$outOfBounds = false;

if($randGetal>0 && $randGetal<$tussenGetal1)
{
$grens1=0;
$grens2=$tussenGetal1;
}

elseif($randGetal>$tussenGetal1 && $randGetal<$tussenGetal2)
{
$grens1=$tussenGetal1;
$grens2=$tussenGetal2;
}

elseif($randGetal>$tussenGetal2 && $randGetal<$tussenGetal3)
{
$grens1=$tussenGetal2;
$grens2=$tussenGetal3;
}

elseif($randGetal>$tussenGetal3 && $randGetal<$tussenGetal4)
{
$grens1=$tussenGetal3;
$grens2=$tussenGetal4;
}

else
{
$outOfBounds = true;
}

if(!$outOfBounds)
{
	$tempTekst = "Het getal ligt tussen ".$grens1." en".$grens2; 
	$tekstResultaat = strrev($tempTekst);
}

else
{
$tekstResultaat="Het getal is out of bounds";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>opdracht-string-conditional-statements-if-elseif</title>
</head>
<body>

	<section>

		<h1>opdracht-conditional-statements-if-elseif</h1>
		
		<p><?php echo($tekstResultaat) ?></p>

	</section>

</body>
</html>
