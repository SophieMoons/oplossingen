<?php

$errorMessage =	false;
	
try
{
	$database = new PDO('mysql:host=localhost;dbname=bieren', 'root', '' );
	
	$orderColumn = 'bieren.biernr';
	$order = 'ASC'; //van hoog naar laag

	if (isset($_GET['orderBy']))
	{
		$orderedArray =	explode('-', $_GET['orderBy']);
		$orderColumn = $orderedArray[0];

		$order = $orderedArray[1];
	}

	$orderQuery	= 'ORDER BY ' . $orderColumn . ' ' . $order;

	if (isset($_GET['orderBy']))
	{
		$order = ($orderedArray[1] != 'DESC') ? 'DESC' :'ASC'; //indien DESC -> ASC
	}

	$query = 'SELECT bieren.biernr,
					 bieren.naam,
					 brouwers.brnaam,
					 soorten.soort,
					 bieren.alcohol 
			  FROM bieren 
			  INNER JOIN brouwers
			  ON bieren.brouwernr	= brouwers.brouwernr
			  INNER JOIN soorten
			  ON bieren.soortnr = soorten.soortnr '. $orderQuery;

	$bierQuery = query($database,$query); //multi-dim array query

	$bierFieldnames = $bierQuery['fieldnames'];

	$bierCorrectFieldnames = correctFieldnames($bierFieldnames); //leesbaarder maken veldnamen
	$bierData = $bierQuery['data'];

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

function correctFieldnames($array)
{
	$resultFieldnames =	array();

	foreach( $array as $value )
	{
		switch( $value )
		{
			case "biernr":
				$name	=	"Biernummer (PK)";
				break;
			case "naam":
				$name	=	"Bier";
				break;
			case "brnaam":
				$name	=	"Brouwer";
				break;
			case "soort":
				$name	=	"Soort";
				break;
			case "alcohol":
				$name	=	"Alcoholpercentage";
				break;
			default:
				$name	=	$value;
		}

		$resultFieldnames[ ] = $name;
	}

	return $resultFieldnames;
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht-CRUD-Query_order_by</title>
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

			.order a
			{
				padding-right:20px;
			}

			.ascending a
			{
				background:	no-repeat url('img/icon-asc.png') right ;
			}

			.descending a
			{
				background:	no-repeat url('img/icon-desc.png') right;
			}

			.selected
			{
				background-color	:	lightgreen;
			}
		</style>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	</head>
<body>

<h1>Overzicht bieren:</h1>

	<?php if ($errorMessage): ?>
		<div class="regular <?= $errorMessage["type"] ?>">
			<?= $errorMessage['text'] ?>
		</div>
	<?php endif ?>

	<table>
		
		<thead>
			<tr>
				<?php foreach ($bierCorrectFieldnames as $key => $fieldName): ?>
					<th class="order <?= ($order == 'ASC' && $orderColumn == $bierFieldnames[$key]) ? 'descending' : 'ascending' ?> <?= ($orderColumn == $bierFieldnames[$key]) ? 'selected' : '' ?>">
						<a href="<?= $_SERVER['PHP_SELF'] ?>?orderBy=<?= $bierFieldnames[$key] ?>-<?= $order ?>">
							<?= $fieldName ?>
						</a>
					</th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($bierData as $key => $brouwer): ?>
				<tr class="<?= (($key + 1) % 2 == 0) ? 'even' : '' ?>">
					<?php foreach ($brouwer as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>

</body>
</html>