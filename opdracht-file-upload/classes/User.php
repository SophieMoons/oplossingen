<?php
class User
{
	private $id	= '';
	private $profilePicture	= ''; 
	private $email = ''; //^ hebben we nodig voor de mail en images op te halen uit database 

	public static function createNewUser($connection, $email, $password)
	{
		$salt = uniqid(mt_rand(), true); //admin paswoord (wordt samengevoegd met gewoon paswoord en wordt gehashed)

		$hashPassword = hash('sha512', $salt . $password); //samenvoegen van salt en paswoord + hashing

		$database = new Database($connection);

		$query = 'INSERT INTO 	users(  email,
										salt,
										hash_password,
										last_login_time)

						VALUES (:email,
								:salt,
								:hash_password,
								NOW())';

		$tokens	= array(':email' => $email,
						':salt' => $salt,
						':hash_password' => $hashPassword);

		$userData =	$database->query($query , $tokens);

		$this->email = $email; //ophalen uit cookie later

		$cookie = $this->createCookie($salt, $email);
			
		return $cookie;
	}

	public static function logout()
	{
		unset($_SESSION['login']);

		$unsetCookie = setcookie('authenticated', '', 0);

		return $unsetCookie;
	}

	public static function createCookie($salt, $email)
	{
		$hashEmail = hash('sha512', $email . $salt);
		$cookieValue =	$email . ',' . $hashEmail;

		$this->email = $email;

		$cookie	=	setcookie('authenticated', $cookieValue, time() + 86400 * 30); //30 dagen geldig

		return $cookie;
	}

	public static function validate($connection)
	{

		if (isset($_COOKIE['authenticated'])) //als men de cookie wilt valideren... (als de cookie geset is)
		{
			$userData =	explode(',', $_COOKIE['authenticated']);
			
			$this->email = $userData[0];

			$saltEmail = $userData[1];

			$database = new Database($connection);

			$userData = $database->query(  'SELECT * 
											FROM users 
											WHERE email = :email', 
											array(':email' => $email));

			if(isset($userData['data'][0])) //als de data van de user geset is...
			{
				$salt = $userData['data'][0]['salt']; //...geef de salt van de email terug

				$newSaltEmail = hash('sha512' , $email . $salt); //eerst controleren of het juist gehashed is

				// geef id en profilepicture
				$this->id = $userData['data'][0]['id'];
				$this->profilePicture = $userData['data'][0]['profile_picture'];

				if ($newSaltEmail == $saltEmail) //komt het overeen, dan is de cookie gevalideerd
				{
					return true;
				}
			
				else
				{
					return false;
				}
			}
		
			else //anders is de cookie niet gevalideerd, logisch
			{
				return false;
			}

		}
	
		else //wanneer niet wilt valideren...
		{
			return false;
		}

	}
	
	public function checkIfUserExists($email)
	{
		$userExists	=	false;

		$checkQuery	=	'SELECT * 
						 FROM users
						 WHERE email = :email';
			
		$placeholders	=	array(':email' => $email);

		$result = $this->database->query($checkQuery, $placeholders);

		if($result)
		{
			$userExists = true;
		}
		
		return $userExists;

	}

	// Help, kan geen this gebruiken
	public function getEmail()
	{
		return $this->email;
	}

	public function getProfilePicture()
	{
		return $this->profilePicture;
	}

	public function getId()
	{
		return $this->id;
	}	
}
?>