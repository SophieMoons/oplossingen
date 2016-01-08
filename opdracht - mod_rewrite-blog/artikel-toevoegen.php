<?php

session_start();

if (isset($_POST['submit']))
{	
	$titel = $_POST['titel'];
	$artikel = $_POST['artikel'];
	$kerwoorden = $_POST['kernwoorden'];
	$datum = $_POST['datum'];

	try
	{
		$connection	= new PDO('mysql:host=localhost;dbname=database-mod_rewrite', 'root', '');

		$query = 'INSERT INTO artikels (titel,
										artikel,
										kernwoorden,
										datum)
					VALUES ("' . $titel . '",	
							"' . $artikel . '",
							"' . $kernwoorden . '",
							'$datum',)'; 	//=> ^ best dat je deze in stringvorm direct zet, makkelijker voor op te halen
		
		if($_POST['titel']!='' && $_POST['artikel']!='' && $_POST['kernwoorden']!='' && $_POST['datum']!='') //moet ingevuld zijn EN email moet correct zijn
		{
			
		}

		else
		{
			$_SESSION['fieldNames']['titel'] = isset($_POST['titel']) ? $_POST['titel'] : '';
			$_SESSION['fieldNames']['artikel'] = isset($_POST['artikel']) ? $_POST['artikel'] : '';
			$_SESSION['fieldNames']['kernwoorden'] = isset($_POST['kernwoorden']) ? $_POST['kernwoorden'] : '';
			$_SESSION['fieldNames']['datum'] = isset($_POST['datum']) ? $_POST['datum'] : '';

			$_SESSION['notification']['type'] = 'error';
			$_SESSION['notification']['text'] = '1 van de velden is niet/incorrect ingevuld, bekijk uw gegevens en probeer opnieuw';
		}

		header('location: artikel-toevoegen-form.php');
	}

	catch(PDOException $e) //in geval van database connection fail
	{
		$_SESSION['notification']['type'] = 'error';
		$_SESSION['notification']['text'] = 'Database connectie niet gelukt';
	}
}

?>