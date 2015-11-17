<?php

function __autoload($Percentage)
{
   include "classes/".$Percentage.".php";
}

$new = 103;
$unit = 100;

$percent = new Percent($new,$unit);
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body>
		<h1>Opdracht-classes-begin</h1>

<table>

	<caption>Hoeveel procent is <?php echo $new ?> van <?php echo $unit ?>?</caption>

	<tr>
		<td>Absoluut</td>
		<td><?php echo $percent->absolute ?></td>
	</tr>
	<tr>
		<td>Relatief</td>
		<td><?php echo $percent->relative ?></td>
	</tr>
	<tr>
		<td>Geheel getal</td>
		<td><?php echo $percent->hundred ?></td>
	</tr>
	<tr>
		<td>Nominaal</td>
		<td><?php echo $percent->nominal ?></td>
	</tr>
</table>
		
</body>
</html>