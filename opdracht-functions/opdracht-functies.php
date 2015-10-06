<?php
#Deel 1
function berekenSom($getal1,$getal2)
{
	$resultaat = $getal1+$getal2;
	return $resultaat;
}

function vermenigvuldig($getal1,$getal2)
{
	$resultaat = $getal1*$getal2;
	return $resultaat;
}

function isEven($getal)
{
	if($getal%2==0)
	{
		$resultaat=true;
	}
	else
	{
		$resultaat=false;
	}

	return $resultaat;
}

$som = berekenSom(20,40);
$product = vermenigvuldig(38,43);
$evenGetal = isEven(46);

#Deel 2
/*function drukArrayAf($array)
{

}*/
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>
	
	<section class="body">
		<h1>opdracht-functions</h1>
		<h2>Deel 1</h2>
		<p><?php echo($som) ?></p>
		<p><?php echo($product) ?></p>
		<p>Het opgegeven getal is <?php echo ($evenGetal)? "een" : "geen" ?> even getal</p>


		<h2>Deel 2</h2>
		<p></p>

	</section>

</body>
</html>