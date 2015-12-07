<?php

$errorMessage=false;

//deel 2
$deleted = false;
$IDDeleted = false;

try
{
	$database=new PDO('mysql:host=localhost;dbname=bieren','root',''); //connecteer met database

	if(isset($_POST['confirm-delete'])) //deel 2
	{
		$deleted = true;
		$IDDeleted = true;
	}

	if ( isset( $_POST['delete'] ) )
	{
		$deleteQuery = 'DELETE FROM brouwers
						WHERE brouwernr = :brouwernr';

		$deletePreparation = $database->prepare($deleteQuery);

		$deletePreparation->bindValue(':brouwernr', $_POST['delete']);

		$isDeleted = $deletePreparation->execute();

		if ($isDeleted)
		{
			$errorMessage['type'] =	'success';
			$errorMessage['text'] =	'De item is succesvol verwijderd.';
		}
		
		else //door de foreign key kunt ge ni deleten
		{
			$errorMessage['type'] =	'error';
			$errorMessage['text'] =	'Deze item kon niet verwijderd worden. Reden: ' . $deletePreparation->errorInfo()[2];
		}
	}

	$query =   'SELECT* FROM brouwers';

	$preparation = $database -> prepare($query);
	$preparation -> execute();

	$brouwerArr = array();

	for ($brouwerNr= 0; $brouwerNr < $preparation->columnCount(); ++$brouwerNr) //alle brouwernamen ophalen
	{
		$brouwerArr[] = $preparation->getColumnMeta($brouwerNr)['name'];
	}

	$brouwerData	=	array();

	while($row = $preparation->fetch(PDO::FETCH_ASSOC))
	{
		$brouwerData[] = $row;
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
		<title>Opdracht-CRUD-Delete</title>
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

			.delete-button
			{
				background-color	:	transparent;
				border				:	none;
				padding				:	0px;
				cursor				:	pointer;
			}

			.confirm-delete
			{
				background-color	:	red;
				color				: 	white;
			}			
		</style>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	</head>
<body>


	<?php if ($errorMessage): ?>
		<div class="regular <?= $errorMessage["type"] ?>">
			<?= $errorMessage['text'] ?>
		</div>
	<?php endif ?>
	
	<?php if ($deleted): ?> <!-- deel 2 !-->
		<div>
			<p>Bent u zeker dat u deze record wilt verwijderen?</p>
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">

				<button type="submit" name="delete" value="<?= $IDDeleted ?>">
					Ja
				</button>

				<button type="submit">
					Ongedaan maken
				</button>
			</form>
		</div>
	<?php endif ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
	<table>
		
		<thead>
			<tr>
				<th>#</th>
					<?php foreach ($brouwerArr as $name): ?>
						<th><?= $name ?></th>
					<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($brouwerData as $key => $brouwerInfo): ?>
				<tr class="<?= (($key + 1) %2 == 0) ? 'even' : '' ?>">
					<td><?= ($key + 1) ?></td>
					<?php foreach ($brouwerInfo as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>

					<td>
						<button type="submit" name="delete" value="<?= $brouwerInfo['brouwernr'] ?>" class="delete-button">
						<img src="img/icon-delete.png" alt="Delete button">
						</button>
					</td>	
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>
	</form>
</body>
</html>