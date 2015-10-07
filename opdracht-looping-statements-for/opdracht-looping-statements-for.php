<?php

#Deel 1
$rijen=10;
$kolommen=10;

$tabel = array();

for($i=0;$i<$rijen;$i++)
{
	$tabel[]='<tr>'; #geen HTML in php!

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


for($i=0;$i<$rijen+1;$i++) #i kan best aantalrijen worden (hetzelfde met j, maakt het minder cryptisch)
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
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
</head>

<body>
	
	<section class="body">
		<h1>opdracht-looping-statements-for</h1>
		<h2>Deel 1</h2>
		<table><?= $kolomResult ?></table> <!-- liefst alternatieve syntax <?= $kolomResult ?>!-->

		<h2>Deel 2</h2>
		<table><?php echo($vermenigResult) ?></table>

		<table>
for()
		</table>

	</section>

</body>
</html>