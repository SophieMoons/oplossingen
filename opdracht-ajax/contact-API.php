<?php
session_start();

if (isset($_POST['submit']))
{
	$admin = 'moonssophie@gmail.com'; //ontvanger
	
	$sender	= $_POST['email'];
	$message = $_POST['message'];
	$sendCopy =	(isset($_POST['sendCopy'])) ? true : false; // wanneer checkbox afgevinkt staat, is het false

	$validEmail = filter_var($sender, FILTER_VALIDATE_EMAIL); //checkt of het wel degelijk een email-adres is

	try
	{
		$connection	= new PDO('mysql:host=localhost;dbname=database-ajax', 'root', '');

		$query = 'INSERT INTO contact_messages (email,
												message,
												time_sent)
					VALUES ("' . $sender . '",
							"' . $message . '",
							NOW())'; 	//email en message => best dat je deze in stringvorm direct zet, makkelijker voor op te halen
		
		if($_POST['message']!='' && $_POST['email']!='' && $validEmail) //moet ingevuld zijn EN email moet correct zijn
		{
			//E-mail				
			$to = $admin;
			$subject = 	'Vraag van: ' . $sender;

			$message = 	'<p>Beste, </p>'.
						'<p>'.$message.'</p>';
										
			$headers = 'From: ' . $sender . "\r\n".
					   'Reply-To: ' . $sender  . "\r\n".
					   'MIME-Version: 1.0'. "\r\n". //heb je nodig om je bericht te kunnen stylen met html
					   'Content-Type: text/html; charset=ISO-8859-1'. "\r\n"; //dit ook

			$messageSent = mail($to, $subject, $message, $headers);	


			$copySent = false; //zijn beide messages verstuurd?
		
			if ($sendCopy) //wanneer vakje aangevinkt, verstuur kopie
			{
				$to = $sender;
				$subject = 'Kopie van vraag aan '. $admin;

				$message =	'<p>Dit is het bericht dat je verstuurde naar: ' . $admin . '<p>'.
							'<p>'.$message.'</p>';
													
				$headers = 	'From: ' . $admin . "\r\n".
							'Reply-To: ' . $admin  . "\r\n".
							'MIME-Version: 1.0'. "\r\n".
							'Content-Type: text/html; charset=ISO-8859-1'. "\r\n";
					
				$copySent = mail($to, $subject, $message, $headers);
			}

			if ($messageSent && $copySent) //verstuurd MET vakje aangevinkt
			{

				if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') //ajax-request?
				{
					$ajaxMessage['type'] = 'success';

					echo json_encode($ajaxMessage);
				}
				
				else
				{
					$_SESSION['notification']['type'] = 'success';
					$_SESSION['notification']['text'] = 'Bericht verstuurd. U zal spoedig uw kopie ontvangen.';
					
					unset($_SESSION['fieldNames']);
					header('location: contact-form.php');
				}
			}

			elseif($messageSent) //ZONDER kopie
			{
				$_SESSION['notification']['type'] = 'success';
				$_SESSION['notification']['text'] = 'Bericht verstuurd.';

				unset($_SESSION['fieldNames']);			
			}
		}

		else
		{
			if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			{
				$ajaxMessage['type'] = 'error';
						
				echo json_encode($ajaxMessage);
			}
				
			else
			{
				$_SESSION['fieldNames']['email'] = isset($_POST['email']) ? $_POST['email'] : '';
				$_SESSION['fieldNames']['message'] = isset($_POST['message']) ? $_POST['message'] : '';
				$_SESSION['fieldNames']['sendCopy'] = isset($_POST['sendCopy']) ? $_POST['sendCopy'] : '';

				$_SESSION['notification']['type'] = 'error';
				$_SESSION['notification']['text'] = 'Bericht niet verstuurd, bekijk uw gegevens en probeer opnieuw';
				
				header('location: contact-form.php');
			}
		}

	}

	catch(PDOException $e) //in geval van database connection fail
	{
		$_SESSION['notification']['type'] = 'error';
		$_SESSION['notification']['text'] = 'Database connectie niet gelukt';
	}
}

?>