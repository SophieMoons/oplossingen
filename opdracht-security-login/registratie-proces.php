<?php

session_start();

function __autoload($class)
{
	require_once('classes/' . $class . '.php');
}

$registrationPage = "registratie-form.php";

if(isset($_POST['password-generator']))
{
	$generatedPassword = generatePassword(8, true, true, true); //voorbeeld: nummers, alfabetisch en uppercase

	$_SESSION['registration']['email'] = $_POST['email'];
	$_SESSION['registration']['password'] =	$generatedPassword;

	header('location: ' . $registrationPage);
}

elseif (isset($_POST['submit']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$_SESSION['registration']['email'] = $email;
	$_SESSION['registration']['password'] =	$password;

	//Email check!
	$validEmail = filter_var($email, FILTER_VALIDATE_EMAIL); //easy, checkt of het wel degelijk een email-adres is
	
	if (!$validEmail)
	{
		$emailError = new Notification("error", "Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in." ); 
		
		header('location: ' . $registrationPage);
	}

	//Passwoord check!
	elseif ($password == '') //elseif -> enkel als de email valid is, mag dit
	{
		new Notification("error", "Foutief. Vul een geldig paswoord in."); 
			
		header('location: ' . $registrationPage);
	}

	else
	{
		//database check voor email
		$connection	= new PDO( 'mysql:host=localhost;dbname=database-security-login', 'root', '' );

		$database = new Database($connection);

		$userData = $database->query( 'SELECT * 
										FROM users 
										WHERE email = :email', 
										array(':email' => $email));

		if (isset($userData['data'][0]))
		{
			$userInUse = new Notification("error", "Sorry, dit email-adres is al in gebruik."); 

			header('location: ' . $registrationPage);
		}

		else
		{
			$newUser = User::CreateNewUser($connection, $email, $password); //functie CreateNewUser oproepen klasse User

			if ($newUser)
			{
				$registrationSuccess = new Notification("success", "U bent succesvol geregistreerd!");
				header('location: registratie-dashboard.php');
			}
		}
	}
}

//
//FUNCTIE GeneratePassword
//

function generatePassword($length, $numeric = false, $alphabetical = true, $upperCase = false, $specialChars = false) //hardcoded, voor te veranderen: hier doen V
{
	$randomPassword = '';
		
	$passwordChars = array();
		
	if ($numeric)
	{
		$passwordChars['numeric'] = array(0,1,2,3,4,5,6,7,8,9);
	}	
		
	if ($alphabetical) 
	{
		$passwordChars['alphabetical'] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	}	
		
	if ($upperCase)
	{
		$passwordChars['upperCase'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	}	
		
	if ($specialChars)
	{
		$passwordChars['specialChars'] = array('#','~','&','$','=','*','<','¤','µ');
	}
		
	$nrOfChars = 0;
		
	while ($nrOfChars < $length) 
	{
		$arrayCount = 0; //loop passwordChars door
		
		foreach ($passwordChars as $value) 
		{
			if ($nrOfChars < $length) 
			{
				
				$randomCharacter = rand(0,(count($value)-1)); //nulwaarde van de value moet altijd 1 zijn!!!
					
				$randomPassword .= $value[$randomCharacter]; //Het willekeurige getal dat maximum zo groot is als het laatste karakter in de array moet toegevoegd worden aan de passwordDump
					
				$nrOfChars++;
			}
				
			$arrayCount++;
		}
	}
		
	$randomPassword = str_shuffle($randomPassword);
		
	return $randomPassword;
}

//
// CLASSES (staan in aparte files nu (User, Database en Notification))
// 


?>