<?php 

	session_start();

	$currentPage = basename($_SERVER['PHP_SELF']); //geeft filenaam terug
	//echo var_dump($currentPage);

	$isValid = FALSE;

	try 
	{
		if (isset($_POST['submit']))
		{			
			if (isset($_POST[ 'code']))
			{
				if(strlen($_POST['code']) !== 8)
				{
					throw new Exception ('LENGTH-ERROR');
				}
				else
				{
					$isValid = TRUE;
				}
			}

			else
			{
				throw new Exception('SUBMIT-ERROR');
			}
		}
	} 

	catch (Exception $ex) 
	{
		$messageCode = $ex->getMessage();

		$message = array();

		$createMessage = FALSE;

		switch($messageCode)
		{
			case 'SUBMIT-ERROR':
				$message['type'] = 'error';
				$message['text'] = 'Het juiste veld ontbreekt';
			break;

			case 'LENGTH-ERROR':
				$message['type'] = 'error';
				$message['text'] = 'De kortingscode heeft niet de juiste lengte';

				$createMessage = TRUE;
			break;
		}

		if ($createMessage)
		{
			createMessage($message);
		}

		logToFile($message);
	}

	$message = getMessage();

	function createMessage($message)
	{
		$_SESSION['message'] = $message;
	}

	function getMessage()
	{
		$message = FALSE;

		if (isset($_SESSION['message']))
		{
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
		}

		return $message;
	}
	
	function logToFile($message)
	{
		$date = '[' . date('H:i:s', time()). ' ' . date('m/d/Y').']'; // vb. [21:15:20 17/11/2015]
		$ipAdress = $_SERVER['REMOTE_ADDR'];

		$errorMessage = $date . ' - ' . $ipAdress . ' - type:[' . $message['type'] . '] ' . $message['text'] . "\r\n";

		file_put_contents('log.txt', $errorMessage, FILE_APPEND);
	}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oplossing error handling: try-catch</title>

        <style>

			label
			{
				display:block;
			}

			.normal
        	{
				margin: 5px 0px;
			    padding: 5px;
			    border-radius: 5px;
        	}

			.error
			{
				font color: #B22222;
				background-color: #F08080;
				max-width: 360px;
				margin-bottom: 10px;
    		}

    		.succes
    		{
    			font-size:22px;
    			margin-left: 40%;
    			margin-right: 40%;
    			font-family:sans-serif;
    		}
        </style>

   <!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    	<link rel="stylesheet" href="http://web-backend.local/css/facade.css">
   		<link rel="stylesheet" href="http://web-backend.local/css/directory.css">
        <title>Opdracht-Error-Handling</title>
    </head>
    <body>

		<h1>Opdracht-Error-Handling</h1>

		<h3>Vul de kortingscode in</h3>

		<?php if($message): ?>

			<div class="normal <?= $message['type'] ?>"><?= $message['text']?></div>
			
		<?php endif ?>
	
		<?php if (!$isValid): ?>
			<form action="<?= $currentPage ?>" method="POST">
			
						<label for="code">Kortingscode (8 karakters lang)</label>
						<input type="text" id="code" name="code">
						<br><br>

				<input type="submit" name="submit">

			</form>
		<?php else: ?>

			<p class = "succes">Korting toegekend! </p>

		<?php endif ?>
    </body>
</html>