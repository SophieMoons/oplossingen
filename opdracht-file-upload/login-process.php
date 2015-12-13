<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php');
}

$loginForm = "login-form.php";

if(isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$_SESSION['login']['email'] = $email;
	$_SESSION['login']['password'] = $password;

	$validEmail = filter_var($email, FILTER_VALIDATE_EMAIL); //een juist emailadres?

	if(!$validEmail)
	{
		$falseEmail = new Notification("error", "Ongeldig e-mailadres, probeer opnieuw");
		header('location: '.$loginForm);
	}

	elseif($password=='') //ongeldig passwoord
	{
		new Notification("error", "Ongeldig paswoord, probeer opnieuw");
		header('location: ',$loginForm);
	}

	else //alles correct, connecteer met database
	{
		$connection	= new PDO( 'mysql:host=localhost;dbname=database-file-upload', 'root', '' );

		$database = new Database($connection);

		$userData = $database->query( 'SELECT * 
										FROM users 
										WHERE email = :email', 
										array(':email' => $email));

		if(isset($userData['data'][0])) //is het paswoord geset?
		{
			$salt = $userData['data'][0]['salt'];
			$passwordDatabase = $userData['data'][0]['hash_password'];

			$newHashPassword = hash('sha512', $salt . $password);

			if ($newHashPassword == $passwordDatabase) //paswoord komt overeen met die van in database?
			{
				$userLogin	=	User::createCookie($salt, $email); //set cookie

				if ($userLogin) //cookie geset?
				{
					$registrationComplete = new Notification("success", "U bent ingelogd");
					header('location: registratie-dashboard.php');
				}
			}

			else //paswoord niet in database gevonden?
			{
				$loginError = new Notification('error', 'Inloggen mislukt, probeer opnieuw');
				header('location: ' . $loginForm);
			}
		}

		else //niet geset?
		{
			$loginError = new Notification('error', '1 van de gegevens is onjuist, controleer en probeer opnieuw');
			header('location: ' . $loginForm);
		}	
	}
}

?>