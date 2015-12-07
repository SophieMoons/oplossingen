<?php

$errorMessage=false;

try
{
	$database=new PDO('mysql:host=localhost;dbname=bieren','root',''); //connecteer met database

	$query =   'SELECT* FROM bieren
				INNER JOIN brouwers
				ON bieren.brouwernr = brouwers.brouwernr
				WHERE bieren.naam LIKE "Du%"
				AND brouwers.brnaam LIKE "%a%"';

	$preparation = $database -> prepare($query);
	$preparation -> execute();

	$bierArr = array();

	while($row = $preparation->fetch(PDO::FETCH_ASSOC)) //geeft de array met de values in een associatieve array (p 63)
	{
		$bierArr[] = $row;
	}

	$columnNames	=	array();
	$columnNames[]	=	'Nr.';

	foreach($bierArr[0] as $key => $bier)
	{
		$columnNames[] = $key;
	}
}

catch(PDOException $e) //in geval van database connection fail
{
	$errorMessage['type'] = 'error';
	$errorMessage['text'] = 'Database connectie niet gelukt';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht-CRUD-Query</title>
		<style>
			.regular
			{
				padding			:	6px;
				border-radius	:	3px;
			}

			.success
			{
				background-color:lightgreen;
			}

			.error
			{
				background-color:red;
			}

			.even
			{
				background-color:lightgrey;
			}
		</style>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	</head>
<body>


	<?php if ( $errorMessage ): ?>
		<div class="regular <?= $errorMessage["type"] ?>">
			<?= $errorMessage['text'] ?>
		</div>
	<?php endif ?>

	<table>
		
		<thead>
			<tr>
				<?php foreach ($columnNames as $name): ?>
					<th><?= $name ?></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($bierArr as $key => $bier): ?>
				<tr class="<?= (($key + 1) %2 == 0) ? 'even' : '' ?>">
					<td><?= ($key + 1) ?></td>
					<?php foreach ($bier as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>

</body>
</html>