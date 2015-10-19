<?php

	session_start();

	if(isset($_POST['submit'])) #data deel 1 wordt verwerkt
    {
        $_SESSION['account']['registratie']['email'] = $_POST['email'];
        $_SESSION['account']['registratie']['nickname'] = $_POST['nickname'];
    }

    $account['registratie'] = $_SESSION['account']['registratie'];

    #Deel 2 (adres)
    if(isset($_SESSION['account']['adres']['straat']))
	{
		$straat = $_SESSION['account']['adres']['straat'];
	}

    if(isset($_SESSION['account']['adres']['nummer']))
	{
		$nummer = $_SESSION['account']['adres']['nummer'];
	}

    if(isset($_SESSION['account']['adres']['gemeente']))
	{
		$gemeente = $_SESSION['account']['adres']['gemeente'];
	}

    if(isset($_SESSION['account']['adres']['postcode']))
	{
		$postcode = $_SESSION['account']['adres']['postcode'];
	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">

	<style>
		.fail 
		{
			font color: #B22222;
			background-color: #F08080;
			padding: 5px;
			max-width: 500px;
			border-radius: 5px;
		}

		li
		{
			list-style: square;
		}

	</style>

</head>
<body>
    </head>
    <body>
		
		<a href="opdracht-sessions-registratie.php?session=destroy">Vernietig sessie</a>
		
		<h1>Registratiegegevens</h1>
		<ul>
		<?php foreach( $account['registratie'] as $data => $value ):  ?>
            <li><?= $data ?>: <?= $value ?></li>
        <?php endforeach ?>
		</ul>

		<h1>Deel 2: Adres</h1>
		<form action="opdracht-sessions-3.php" method="POST"> <!-- processing van data deel 2 gebeurd in php deel 3!-->
			
			<ul>
				<li>
					<label for="straat">straat</label>
					<input type="text" id="straat" name="straat"> <!-- value="<?= $straat ?>"<?= (isset($_GET['focus']) && $_GET['focus'] == "straat") ? 'autofocus' : '' ?>!-->
				</li>
				<li>
					<label for="nummer">nummer</label>
					<input type="text" id="nummer" name="nummer"> <!-- value="<?= $nummer ?>"<?= (isset($_GET['focus']) && $_GET['focus'] == "nummer") ? 'autofocus' : '' ?>!-->
				</li>
				<li>
					<label for="gemeente">gemeente</label>
					<input type="text" id="gemeente" name="gemeente"> <!-- value="<?= $gemeente ?>"<?= (isset($_GET['focus']) && $_GET['focus'] == "gemeente") ? 'autofocus' : '' ?> -->
				</li>
				<li>
					<label for="postcode">postcode</label>
					<input type="text" id="postcode" name="postcode"> <!-- value="<?= $postcode ?>"<?= (isset($_GET['focus']) && $_GET['focus'] == "postcode") ? 'autofocus' : '' ?> !-->
				</li>
			</ul>

			<input type="submit" name="submit" id="submit" value="Verstuur">

		</form>

		
    </body>
</html>