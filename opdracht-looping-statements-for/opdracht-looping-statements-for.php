<?php

#Deel 1
$rijen=10;
$kolommen=10;

$tabel = array();

for($i=0;$i<$rijen;$i++)
{
	$tabel[]='<tr>';

	for($j=0;$j<$kolommen;$j++)
	{
		$tabel[]='<td>kolom</td>';
	}

	$tabel[]='</tr>';		
}

$kolomResult=implode("\n", $tabel);

#Deel 2
$tabel2=array();
$uitkomstVermenig=0;


for($i=0;$i<$rijen+1;$i++)
{
	$tabel2[]='<tr>';

	for($j=0;$j<$kolommen+1;$j++)
	{
		$uitkomstVermenig=($j)*($i);
		$tabel2[]='<td>'.$uitkomstVermenig.'</td>';
	}

	$tabel2[]='</tr>';		
}

$vermenigResult=implode("\n",$tabel2);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	
	<section class="body">
		<h1>opdracht-looping-statements-for</h1>
		<h2>Deel 1</h2>
		<table><?php echo($kolomResult) ?></table>

		<h2>Deel 2</h2>
		<table><?php echo($vermenigResult) ?></table>

	</section>

</body>
</html>