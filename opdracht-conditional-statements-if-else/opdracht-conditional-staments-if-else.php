<?php

#deel 1
$randJaar = rand(1800,2015);
$schrikkelJaar = false;

if($randJaar%4 == 0 || $randJaar%100 != 0 && $randJaar%400 == 0)
{
	$schrikkelJaar=true;
}

else
{
	$schrikkeljaar=false;
}

#deel 2
$secondes = rand(10000,99999999);

$minuten = round($secondes/60,0,PHP_ROUND_HALF_DOWN);
$uren =round($minuten/60,0,PHP_ROUND_HALF_DOWN);
$dagen =round($uren/24,0,PHP_ROUND_HALF_DOWN);
$weken=round($dagen/7,0,PHP_ROUND_HALF_DOWN);
$maanden=round($dagen/31,0,PHP_ROUND_HALF_DOWN);
$jaren =round($dagen/365,0,PHP_ROUND_HALF_DOWN);


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>opdracht-string-conditional-statements-if-else</title>
</head>
<body>

	<section>

		<h1>opdracht-conditional-statements-if-else</h1>

		<h2>Deel 1</h2>
		
		<p>Het jaar is: <?php echo ($randJaar)?> en het is <?php echo($schrikkelJaar) ? "een" : "geen" ?> schrikkeljaar.</p> 

		<h2>Deel 2</h2>
		
		<p>In <?php echo($secondes) ?> seconden zijn er:</p>
		<ul>
			<li><?php echo($minuten) ?> minuten</li>
			<li><?php echo($uren) ?> uren</li>
			<li><?php echo($dagen) ?> dagen</li>
			<li><?php echo($weken) ?> weken</li>
			<li><?php echo($maanden) ?> maanden (31 dagen)</li>
			<li><?php echo($jaren) ?> jaren (365 dagen)</li>
		</ul>

	</section>

</body>
</html>
