<?php

$errorMessage = false;
$selectedBrouwer = false;

try
{
	$database=new PDO('mysql:host=localhost;dbname=bieren','root',''); //connecteer met database

	//brouwers
	$brouwerQuery =   'SELECT brnaam, brouwernr FROM brouwers';

	$brouwerPreparation = $database -> prepare($brouwerQuery);
	$brouwerPreparation -> execute();

	$brouwerArr = array();

	while($row = $brouwerPreparation->fetch(PDO::FETCH_ASSOC)) //geeft de array met de values in een associatieve array (p 63)
	{
		$brouwerArr[] = $row;
	}

	//bieren
	if(isset($_GET['brouwernr'])) //wanneer de brouwernr is gevonden, geef hun bieren weer
	{
		$selectedBrouwer = $_GET['brouwernr'];

		$bierQuery = 'SELECT bieren.naam FROM bieren
					  WHERE bieren.brouwernr = :brouwernr';

		$bierPreparation = $database->prepare($bierQuery);
		$bierPreparation->bindParam(':brouwernr',$_GET['brouwernr']);
	}

	else //anders geef je gewoon alle bieren mee
	{
		$bierQuery = 'SELECT bieren.naam FROM bieren';

		$bierPreparation = $database->prepare($bierQuery);
	}

	$bierPreparation->execute();

	//kolomnamen bieren
	$bierKolom = array();
	$bierKolom[]	= 'Aantal';

	for ($columnNumber = 0; $columnNumber < $bierPreparation->columnCount(); ++$columnNumber) 
	{ 
		$bierKolom[] = $bierPreparation->getColumnMeta($columnNumber)['name'];
	}

	$bierArr = array();

	while($row = $bierPreparation->fetch(PDO::FETCH_ASSOC))
	{
		$bierArr[] = $row['naam'];
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

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
		<select name="brouwernr">
			<?php foreach ($brouwerArr as $key => $brouwer): ?>
				<option value="<?= $brouwer['brouwernr'] ?>" <?= ($selectedBrouwer == $brouwer['brouwernr']) ? 'selected' : '' ?>>
					<?= $brouwer['brnaam'] ?>
				</option>
			<?php endforeach ?>
		</select>
		
		<input type="submit" value="Geef mij alle bieren van deze brouwerij">
	
	</form>

		<table>
		
			<thead>
				<tr>
					<?php foreach ($bierKolom as $columnName): ?>
						<th><?= $columnName ?></th>
					<?php endforeach ?>
				</tr>
			</thead>

			<tbody>
			
				<?php foreach ($bierArr as $key => $bier): ?>
					<tr class="<?= (($key + 1) %2 == 0) ? 'even' : '' ?>">
						<td><?= ($key + 1) ?></td>
						<td><?= $bier ?></td>
					</tr>
				<?php endforeach ?>
			
			</tbody>
		</table>
	</body>
</html>