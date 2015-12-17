<?php
session_start();

$notification=false;

if(isset($_SESSION['fieldNames']))
{
	$email = $_SESSION['fieldNames']['email'];
	$message = $_SESSION['fieldNames']['message'];
	$sendCopy =	$_SESSION['fieldNames']['sendCopy'];

	var_dump($message);
}

if(isset($_SESSION['notification'])) //als er een notificatie is...
{
	$notification['type'] = $_SESSION['notification']['type'];
	$notification['text'] = $_SESSION['notification']['text'];

	unset($_SESSION['notification']); //terug unsetten hierna
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
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">

</head>
<body>

<h1>Contacteer ons</h1>

	<?php if ($notification): ?>
		<div class="regular <?= $notification['type'] ?>">
			<?= $notification['text'] ?>
		</div>
	<?php endif ?>

	<div id="form-holder"> <!-- Makkelijkste manier om met Ajax iets toe te voegen (idg extra notifications) -->

	<form action="opdracht-ajax.php" method="post" id="mail-form"> <!-- mail form in AJAX-->
		<ul>			
			<li>
				<label for="email">E-mailadres</label>
				<input type="text" id="email" name="email" value="<?php echo (isset($email)) ? $email : '' ?>">
			</li>
			
			<li>
				<label for="message">Boodschap</label>
				<textarea id="message" name="message"><?php echo (isset($message)) ? $message : '' ?></textarea>
			</li>
			
			<li>
				<label for="send-copy">Stuur een kopie naar mezelf</label>
				<input type="checkbox" id="sendCopy" name="sendCopy" <?php echo (isset($sendCopy)) ? 'checked' : '' ?>>
			</li>	
		</ul>
		
		<input type="submit" id="submit" name="submit">

	</form>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> <!-- ipv door de normale php, wordt het door de andere ajax-script verwerkt, sneller -->
	<script>
	
	// Voer de code pas uit wanneer alle HTML-elementen geladen zijn.
	$(function()
	{
		// jQuery heeft een methode die luistert naar wanneer iemand een formulier probeert te submitten: de submit()-methode
		$('#mail-form').submit(function()
		{
			// Formdata ophalen
			// De serialize-methode zet automatisch alle inputvelden om naar het nodige formaat om doorgestuurd te kunnen worden als post of get-variabele.
			var formData = $('#mail-form').serialize();
			console.log('formData:' + formData);

			// Een simpele ajax-request
			$.ajax(
			{
				type: 'POST',
				url: 'contact-API.php',
				data: formData,
				success: function(data)
				{
					// De parameter 'data' is niet verplicht en hangt af van de situatie, maar aan te raden (vooral voor debugging)
					// Deze parameter bevat de returnwaarde van de pagina die het heeft opgeroepen.

					// De data wordt teruggegeven in JSON-formaat, maar wordt voorlopig nog geïnterpreteerd als een normale string
					console.log( "data", data );
					// Deze string moet eerst nog omgezet worden naar leesbare JSON
					parsedData	=	JSON.parse(data);

					if (parsedData['type'] == "success")
					{
						$('#form-holder').append('<p class="regular">Uw bericht is verzonden</p>');
					}
																
					else if (parsedData['type'] == "error")
					{
						$('#form-holder').prepend('<p class="error">Error, probeer opnieuw</p>');
					}
				}
			})

		// Zeker niet vergeten return false toe te passen, anders zal het formulier automatisch verstuurd worden.
		// Dit proberen we tegen te gaan
		return false;
		})
				
	})

	</script>
</body>
</html>