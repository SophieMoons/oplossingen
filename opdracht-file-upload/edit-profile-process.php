<?php

session_start();

function __autoload($class)
{
	require_once('classes/'. $class . '.php');
}

spl_autoload_register( '__autoload' );

define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
define('HOST', dirname(BASE_URL) . '/');

$connection = new PDO('mysql:host=localhost;dbname=database-file-upload', 'root', '');

$user = new User(); // NODIG VOOR ID EN DERGELIJKE OP TE HALEN (WERKT NIET)

if (User::validate($connection)) //checkt of de cookie geset is
{
	$notification =	Notification::getNotification();
}

else
{
	User::logout(); //cookie en sessie worden unset

	new notification('error', "U moet eerst inloggen"); //error wordt aangegeven

	header('location: login-form.php');
}

if(isset($_POST['submit']))
{
	$newFileName = false;

    if($_FILES['profilePicture']['error'] !== 4) //geldigheid testen
    {
        $isValid = 0; // > O = ongeldig 

		if ((($_FILES["profilePicture"]["type"] !== "image/png")
		||   ($_FILES["profilePicture"]["type"] !== "image/jpeg")
		||   ($_FILES["profilePicture"]["type"] !== "image/gif"))
		&&   ($_FILES["profilePicture"]["size"] > 2000000)) 
   	 	{
			++$isValid;
    	}

    	if ($isValid > 0) //ongeldig?
    	{
       	 	new Notification('error',"Het bestand is niet geldig, probeer opnieuw");
      		header('location: edit-profile.php');
    	}
        
   		else
    	{
     	   $newFileName = createNewFileName($_FILES['profilePicture']['name']);

			/* De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
			Zo weet de server waar het bestand moet terecht komen.
			We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)*/
			define('ROOT',dirname(__FILE__));

       	 	while (file_exists(ROOT . 'img/' . $newFileName)) //genereer nieuwe naam als de file al bestaat
        	{
            	$newFileName = createNewFileName($_FILES['profilePicture']['name']);
       		}
           
        	move_uploaded_file( $_FILES['profilePicture']['temp_name'], (ROOT . '/img/' . $newFileName)); //uploaden naar img map
     	}
	}

	if ($newFileName) //uploaden voltooid, nu naar database sturen
	{
		$userID = $user->getId();////id ophalen!!! (WERKT NIET)

   	 	$editGegevensQuery = 'UPDATE users
    	                      SET profile_picture = :profile_picture
        	                  WHERE id = :id';

    	$editGegevensPlaceholders = array( ':profile_picture' => $newFileName,
                                       	   ':id' => $userID);

   		$connection->query($editGegevensQuery, $editGegevensPlaceholders);

    	new Notification('succes',"Uw gegevens zijn opgeslagen");
        header('location: edit-profile.php');
    }

    //
	//IMAGE MANIPULATION (max 400x400)
    //

	// Haal de bestandsnaam en de extensie uit het bestand
	$fileParts	=	pathinfo($newFileName);
	$fileName	=	$fileParts['filename'];
	$ext		=	$fileParts['extension'];

	// Bepaal de dimensies van de verkleining
	$thumbDimensions['w']	=	400;
	$thumbDimensions['h']	=	400;

	// Haal de breedte en de hoogte op uit het originele bestand
	list($width, $height) = getimagesize($newFileName); // kent automatisch de value uit getimagesize (retunt array(width, height)) toe aan de variabele in de list in de overeenstemmende volgorde

	// Controleer om welke extensie het gaat en voer de overeenstemmende methode uit
	switch ($ext)
	{
		case ('jpg'):
		case ('jpeg'):
			$source 	= 	imagecreatefromjpeg($newFileName);
			break;
			
		case ('png'):
			$source 	=	imagecreatefrompng($newFileName);
			break;

		case ('gif'):
			$source 	=	imagecreatefromgif($newFileName);
			break;
	}

	// Creëer een leeg canvas met de dimensies van de nieuwe afbeelding
	$thumb 	=	imagecreatetruecolor($thumbDimensions['w'], $thumbDimensions['h']);

	// Resize het origineel naar de gewenste dimensies en plaats het de verkleinde versie in het nieuwe canvas.
	// nieuwe canvas = destination, oude canvas = source, destination x, destination y, source x, source y, destination width, destination height, source width, source height
	imagecopyresized($thumb, $source, 0,0,0,0, $thumbDimensions['w'],$thumbDimensions['h'], $width, $height);

	// Slaag het nieuwe canvas op (canvas, (folder).fileName, kwaliteit)
	switch ($ext)
	{
		case ('jpg'):
		case ('jpeg'):
			$resized = imagejpeg($thumb, ($fileName. '_thumb.' . $ext), 100);
			break;
			
		case ('png'):
			$resized = imagepng($thumb, ($fileName. '_thumb.' . $ext), 100);
			break;

		case ('gif'):
			$resized = imagegif($thumb, ($fileName. '_thumb.' . $ext));
			break;
	}
	//
	//EIND MANIP
	//	
}
    
function createNewFileName($fileName)
{
    $newFileName =  time() . '_' . $fileName; 
        
    return $newFileName;
}

?>