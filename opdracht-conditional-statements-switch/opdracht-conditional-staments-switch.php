<?php

#deel 1
$randGetal = rand(1,7);
$dag = '';


switch($randGetal){ #veel beter, stel je voor... allemaal ifs
	case 1:
	$dag='Maandag';
	break;

	case 2:
	$dag = 'Dinsdag';
	break;

	case 3:
	$dag='Woensdag';
	break;

	case 4:
	$dag='Donderdag';
	break;

	case 5:
	$dag='Vrijdag';
	break;

	case 6:
	$dag='Zaterdag';
	break;

	case 7:
	$dag='Zondag';
	break;
}

$dag = strtolower($dag);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/global.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/directory.css">
	<link rel="stylesheet" type="text/css" href="http://web-backend.local/css/facade.css">
	<title>opdracht-string-extra-functions</title>
</head>
<body>

	<section>

		<h1>opdracht-conditional-statements-switch</h1>
		
		<p><?= $dag ?></p> 

	</section>

</body>
</html>
