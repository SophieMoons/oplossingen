<?php

$notification=false;
$deleted = false;
$IDDeleted = false;
$edited = false;

try
{
	$database=new PDO('mysql:host=localhost;dbname=bieren','root',''); //connecteer met database

	if(isset($_POST['confirm-delete']))
	{
		$deleted = true;
		$IDDeleted = true;
	}

	if(isset($_POST['confirm-edit'])) //info en namen voor specifieke brouwer
	{
		$edited = query($database,'SELECT * FROM brouwers WHERE brouwernr = :brouwernr',
						array(':brouwernr' => $_POST['confirm-edit']));
	}

	if(isset($_POST['edit']))
	{
		$updateQuery = 'UPDATE brouwers
						SET brnaam = :brnaam,
							adres =	:adres,
							postcode = :postcode,
							gemeente = :gemeente,
							omzet = :omzet
						WHERE brouwernr	= :brouwernr
						LIMIT 1'; //enkel de 1ste rij

		$preparation = $database->prepare($updateQuery);

		$preparation->bindValue(":brouwernr", $_POST['brouwernr']);						
		$preparation->bindValue(":brnaam", $_POST['brnaam']);						
		$preparation->bindValue(":adres", $_POST['adres']);						
		$preparation->bindValue(":postcode", $_POST['postcode']);						
		$preparation->bindValue(":gemeente", $_POST['gemeente']);						
		$preparation->bindValue(":omzet", $_POST['omzet']);

		$updateComplete = $statement->execute();

		if ( $updateComplete )
			{
				$notification['type'] =	'success';
				$notification['text'] = 'Brouwer update' . $_POST['brnaam'] . ' completed.';
			}
			else
			{
				$notification['type'] =	'error';
				$notification['text'] = 'Brouwer update ' . $_POST['brnaam'] . ' kon niet uitgevoerd worden. Probeer opnieuw. Bij aanhoudende problemen, contacteer de <a href="mailto:kissmybutt@gmail.com">systeembeheerder</a>.';
			}			

	}

	if (isset($_POST['delete']))
	{
		$deleteQuery = 'DELETE FROM brouwers
						WHERE brouwernr = :brouwernr';

		$deletePreparation = $database>prepare($deleteQuery);

		$deletePreparation-> bindValue(':brouwernr', $_POST['delete']);

		$deleted = $deletePreparation-> execute();

		if ($deleted)
		{
			$message['type'] = 'success';
			$message['text'] = 'Item succesvol verwijderd';
		}

		else	
		{
			$message['type'] = 'error';
			$message['text'] = 'Item niet verwijderd: ' . $deletePreparation->errorInfo()[2]; //specifiek probleem wordt getoond
		}
	}

	$query =   query($database,'SELECT* FROM brouwers');

	$brouwerFieldname = $query['fieldnames'];
	$brouwerData =	$query['data'];
}

catch(PDOException $e) //in geval van database connection fail
{
	$errorMessage['type'] = 'error';
	$errorMessage['text'] = 'Database connectie niet gelukt';
}

function query($db, $tempQuery, $tokens = false) //makkelijker voor meerdere arrays  van data terug te geven in een query (multi-dim)
{
	$preparation = $db->prepare($tempQuery);
	
	if ($tokens)
	{
		foreach ($tokens as $token => $tokenValue)
		{
			$preparation->bindValue($token, $tokenValue);
		}
	}

	$preparation->execute();

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

	$resultArray['fieldnames']	=	$brouwerArr;
	$resultArray['data']		=	$brouwerData;

	return $resultArray; //multi-dim array met fieldnames en data array
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
		
		<title>Opdracht-CRUD-Update</title>
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
	</head>
<body>


	<?php if ($notification): ?>
		<div class="regular <?= $notification["type"] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>
	
	<?php if ($edited):?>
		<div>
			<form action="<?= $_SERVER[ 'PHP_SELF' ] ?>" method="POST">
				<ul>
					<?php foreach ($edited['data'][0] as $fieldname => $value): ?>
						
						<?php if ( $fieldname != "brouwernr" ): ?>
							<li>
								<label for="<?= $fieldname ?>"><?= $fieldname ?></label>
								<input type="text" id="<?= $fieldname ?>" name="<?= $fieldname ?>" value="<?= $value ?>">
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
				<input type="hidden" value="<?= $edited['data'][0]['brouwernr'] ?>" name="brouwernr">
				<input type="submit" name="edit" value="Wijzigen">
			</form>
		</div>
	<?php endif ?>	

	<?php if ($deleted): ?>
		
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
					<?php foreach ($brouwerFieldname as $fieldname): ?>
						<th><?= $fieldname ?></th>
					<?php endforeach ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($brouwerData as $key => $brouwer): ?>
					<tr class="<?= ( ($key+1)%2 == 0 ) ? 'even' : ''  ?> <?= ($brouwer['brouwernr'] === $IDDeleted) ? 'confirm-delete' : ''  ?>">
						<?php foreach ($brouwer as $value): ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
						<td>
							<button type="submit" name="confirm-delete" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="img/icon-delete.png" alt="Delete button">
							</button>
						</td>
						<td>
							<button type="submit" name="confirm-edit" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="img/icon-edit.png" alt="Edit button">
							</button>
						</td>
					</tr>
				<?php endforeach ?>
				
			</tbody>

		</table>
	</form>
</body>
</html>