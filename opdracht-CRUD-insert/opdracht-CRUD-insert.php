<?php

$notification=false;

if(isset($_POST['submit']))
{
	try
	{
		$database=new PDO('mysql:host=localhost;dbname=bieren','root',''); //connecteer met database

		$query =   'INSERT INTO brouwers(brnaam,adres,postcode,gemeente,omzet)
					VALUES (:brnaam,:adres,:postcode,:gemeente,;omzet)';

		$preparation = $database -> prepare($query);
		
		$preparation->bindValue(':brnaam', $_POST['brnaam']);
		$preparation->bindValue(':adres', $_POST['adres']);
		$preparation->bindValue(':postcode', $_POST['postcode']);
		$preparation->bindValue(':gemeente', $_POST['gemeente']);
		$preparation->bindValue(':omzet', $_POST['omzet']);

		$brouwerAdded = $preparation -> execute();

		if($brouwerAdded)
		{
			$insertID = $database->lastInsertId();
			$notification['type'] = 'success';
			$notification['text'] = 'Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is ' . $insertId . '.';
		}

		else
		{
			$notification['type'] = 'error';
			$notification['text'] =	'Er ging iets mis met het toevoegen, probeer opnieuw';
		}

	}

	catch(PDOException $e) //in geval van database connection fail
	{
		$notification['type'] = 'error';
		$notification['text'] = 'Database connectie niet gelukt';
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
		<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	</head>
		<title>Oplossing oefening 023 - a</title>
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

	<h1>Voeg nieuwe brouwer toe</h1>

	<?php if ($notification): ?>
		<div class="regular <?= $notification["type"] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>

	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		
		<ul>
			<li>
				<label for="brnaam">Brouwernaam</label>
				<input type="text" name="brnaam" id="brnaam">
			</li>
			<li>
				<label for="adres">Adres</label>
				<input type="text" name="adres" id="adres">
			</li>
			<li>
				<label for="postcode">Postcode</label>
				<input type="text" name="postcode" id="postcode">
			</li>
			<li>
				<label for="gemeente">Gemeente</label>
				<input type="text" name="gemeente" id="gemeente">
			</li>
			<li>
				<label for="omzet">Omzet</label>
				<input type="text" name="omzet" id="omzet">
			</li>
		</ul>
		
		<input type="submit" value="Voeg toe" name="submit">
	</form>

</body>
</html>